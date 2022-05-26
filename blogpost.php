<?php
session_start();
require "dbconn.php";

$title;

//Exit page by default, unless there is a post to load
$exitPage = true;

//If there is a post id in get then load the page
if(isset($_GET["post_id"])) {

    $id = $_GET["post_id"];

    $query = "SELECT title from Blog_Post WHERE post_id = '$id' AND archived='0';";

    $result = $conn->query($query);

    //If there is a post, then set the page title to that posts title, and don't exit the page
    if($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $title = $row["title"];

        $exitPage = false;
    }
} 
//If there was no post to load, back home we go!
if($exitPage) {
    header('Location: index.php');
}

//Comment Handling
//If there is a comment in POST, load it and upload to database
if(isset($_POST["comment"])) {

    //Grabbing post id from GET, comment from POST, and username from SESSION, round the world!
    $id = $_GET["post_id"];
    $body = $conn->real_escape_string(htmlentities($_POST["comment"]));
    $user = $_SESSION["username"];

    $query = "INSERT INTO 
    Comment (post_id, comment_body, username) 
    VALUES ('$id', '$body', '$user');";

    $result = $conn->query($query);

    if(!$result) {
        echo "Something went wrong here! Couldn't upload comment";
    }
    //Unset POST
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
    <title><?php echo $title; ?> - Comments</title>
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

        //If the post exists, print out in the same format as index.php
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

            //Once the post has been printed out, load all the comments in
            loadComments();

        } else {
            //Otherwise return to index.php
            echo "Something went wrong here!";
            header('Location: index.php');
        }


        //Loads comments in and prints them out if they exist, creates comment form
        function loadComments() {
            global $conn;
            global $id;

            $query = "SELECT post_id, comment_body, username, 
            DATE_FORMAT(date, \"%d %M %Y\") AS 'date' 
            FROM Comment WHERE post_id = '$id'";

            $result = $conn->query($query);
            //This is for the styling/formatting
            echo "<section class=\"comments-wrapper\">";

            if($result) {
                //If there are comments we want to display a different message in the form
                $commentsExist = $result->num_rows > 0;
                //Hide Comment form if the user is a visitor
                if(isset($_SESSION["role"]) && $_SESSION["role"] != "Visitor") {
                    //Create comment form with appropriate html
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

                //If Comments exist loop through the results and print them out in similar formatting to the post
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