<?php
session_start();
require "dbconn.php";

$title;

//If there is a post id in get, and the user is not a visitor, they can use this page
if (isset($_GET["post_id"]) && isset($_SESSION["role"]) && $_SESSION["role"] != "Visitor") {

    $id = $_GET["post_id"];

    $query = "SELECT title, archived, post_id from blogPost WHERE post_id = '$id' AND archived='0';";

    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $title = $row["title"];
    } else {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
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
    <link rel="stylesheet" href="css/index.css?ts=<?= time() ?>" />

    <script src="js/navbar.js" defer></script>
</head>

<body>
    <!-- Blog posts in reverse chronological order -->
    <?php
    require "navbar.php";
    ?>
    <main class="blog-posts">
        <?php
        $query = "SELECT username,
        title, 
        post_body, 
        post_image,
        archived, 
        DATE_FORMAT(post_date, \"%d %M %Y\") AS 'date'
        from blogPost WHERE post_id = '$id';";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
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

            $query = "SELECT post_id, comment_body, username, DATE_FORMAT(date, \"%d %M %Y\") AS 'dob' from Comment WHERE post_id = '$id'";

            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                echo "<article class=\"blog-post\">";
                echo "<div class=\"blog-post-text\">";
                echo "<h3 style=\"font-weight: 300; \">" . $row["username"] . "</h3>";
                echo "<h3>" . $row["date"] . "</h3>";
                echo "<p>" . $row["post_body"] . "</p>";
                echo "</div>";
                echo "</article>";
            }
        } else {
            echo "Something went wrong here!";
            //header('Location: index.php');
        }
        ?>
    </main>
</body>

</html>