<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
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
    require "dbconn.php";
    ?>
    <main class="blog-posts">
        <?php

        // //hide create post button if role != author
        if (isset($_SESSION["role"]) && $_SESSION["role"] == "Author") {
            echo "<button class=\"create-post-button\" onclick=\"window.location.href = 'create.php';\">";
            echo "<img class=\"create-post-icon\" src=\"images/pen-paper-icon.png\" />Create Post";
            echo "</button>";
        }

        //Select blog details where they aren't archived,
        //format date to look nice
        $query = "SELECT username,
        title, 
        post_body, 
        post_image,
        archived, 
        post_id,
        DATE_FORMAT(post_date, \"%d %M %Y\") AS 'date'
        from Blog_Post WHERE archived = \"0\" 
        ORDER BY post_date DESC;";
        
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<article class=\"blog-post\">";
                echo "<div class=\"blog-post-text-button-wrapper\">";
                echo "<div class=\"blog-post-text\">";
                echo "<h2>" . $row["title"] . "</h2>";
                echo "<h3 style=\"font-weight: 300; \">" . $row["username"] . "</h3>";
                echo "<h3>" . $row["date"] . "</h3>";
                echo "<p>" . $row["post_body"] . "</p>";
                //comments button
                echo "</div>";
                echo "<section class=\"user-buttons-wrapper\">";
                echo "<button class=\"comments-button\""; 
                echo "onclick=\"window.location.href = 'blogpost.php?post_id=" . $row["post_id"] . "'\">";
                echo "Comments";
                echo "</button>";    
                if(isset($_SESSION["username"]) && $_SESSION["username"] == $row["username"]) {
                    echo "<button class=\"comments-button edit-button\"";
                    echo "onclick=\"window.location.href = 'create.php?edit=" . $row["post_id"] . "'\">";
                    echo "Edit Post";
                    echo "</button";
                }
                echo "</section>";
                echo "</div>";

                echo "<img class=\"blog-post-image\" src=\"" . $row["post_image"] . "\">";
                echo "</article>";
            }
        }
        ?>
    </main>
</body>

</html>