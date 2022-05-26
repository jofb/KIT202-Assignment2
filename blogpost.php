<?php
session_start();
require "dbconn.php";

$title;

//If there is a post id in get, and the user is not a visitor, they can use this page
if(isset($_GET["post_id"])) {

    $id = $_GET["post_id"];

    $query = "SELECT title, archived, post_id from Blog_Post WHERE post_id = '$id' AND archived='0';";

    $result = $conn->query($query);

    if($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $title = $row["title"];
    } else {
       header('Location: index.php');
    }
} else {
    header('Location: index.php');
}

if(isset($_POST["comment"])) {
    //sort out values

    $id = $_GET["post_id"];
    $body = $conn->real_escape_string(htmlentities($_POST["comment"]));
    $user = $_SESSION["username"];
    //put into query

    $query = "INSERT INTO 
    Comment (post_id, comment_body, username) 
    VALUES ('$id', '$body', '$user');";

    $result = $conn->query($query);

    if(!$result) {
        echo "Something went wrong here!";
    }
    //unset post
    unset($_POST["comment"]);
    //Reload the page fully to clear POST and stop comment from resubmitting
    header('Location: blogpost.php?post_id=' . $_GET["post_id"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title; ?></title>
    <!-- Font load -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&family=Poppins:wght@100;300;400;600;700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="images/camera.png" type="image/x-icon" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/navbar.css?ts=<?= time() ?>" />
    <link rel="stylesheet" href="css/style.css?ts=<?= time() ?>" />
    <link rel="stylesheet" href="css/comment.css?ts=<?= time()?> /">

    <script src="js/navbar.js" defer></script>
</head>

<body>
    <!-- Blog posts in reverse chronological order -->
    <?php
    require "navbar.php";
    ?>
    <main class="blog-posts">
        <?php
        //First check if the post exists
        $query = "SELECT username,
        title, 
        post_body, 
        post_image,
        archived, 
        DATE_FORMAT(post_date, \"%d %M %Y\") AS 'date'
        from Blog_Post WHERE post_id = '$id';";
        $result = $conn->query($query);

        if($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            echo "<article class=\"blog-post\">";
            echo "<div class=\"blog-post-text\">";
            echo "<h2>" . $row["title"] . "</h2>";
            echo "<h3 style=\"font-weight: 300; \">" . $row["username"] . "</h3>";
            echo "<h3>" . $row["date"] . "</h3>";
            echo "<p>" . $row["post_body"] . "</p>";
            echo "</div>";
            echo "<img class=\"blog-post-image\" src=\"" . $row["post_image"] . "\">";
            echo "</article>";

            loadComments();

        } else {
            echo "Something went wrong here!";
            header('Location: index.php');
        }

        function loadComments() {
            global $conn;
            global $id;
            $query = "SELECT post_id, comment_body, username, DATE_FORMAT(date, \"%d %M %Y\") AS 'date' from Comment WHERE post_id = '$id'";
            $result = $conn->query($query);

            echo "<section class=\"comments-wrapper\">";

            if($result) {
                $commentsExist = $result->num_rows > 0;
                //Hide Comment form if the user is a visitor
                if(isset($_SESSION["role"]) && $_SESSION["role"] != "Visitor") {
                    echo "<form name=\"comment-form\" 
                    method=\"POST\" action=\"" . 
                    htmlspecialchars($_SERVER["PHP_SELF"]) . "?post_id=" . $_GET["post_id"] . "\">";
                    echo "<textarea required minlength=\"10\" maxlength=\"200\" name=\"comment\" class=\"blog-post comment add-comment\" rows=\"2\" cols=\"150\" placeholder=\"";

                    //If there are comments use normal comment message then print them out
                    if($commentsExist) {
                        echo "Comment...";
                    } else {
                        //If there are none print this cute message
                        echo "There are no comments! You should add one...";
                    }
                    echo "\"></textarea>";
                    echo "<input value=\"Post Comment\" type=\"submit\" class=\"submit-button\" name=\"submit\"/>";
                    echo "</form>";
                }

                if($commentsExist) {
                    while($row = $result->fetch_assoc()) {
                        echo "<article class=\"blog-post comment\">";
                        echo "<div class=\"blog-post-text\">";
                        echo "<h3 style=\"font-weight: 300; \">" . $row["username"] . "</h3>";
                        echo "<h3>" . $row["date"] . "</h3>";
                        echo "<p>" . $row["comment_body"] . "</p>";
                        echo "</div>";
                        echo "</article>";
                    }
                }   
            }

            echo "</section>";
        }
        ?>
    </main>
</body>

</html>