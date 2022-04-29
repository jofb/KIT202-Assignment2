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
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/index.css" />

    <script src="js/navbar.js" defer></script>
</head>

<body>
    <!-- Blog posts in reverse chronological order -->
    <?php
    require "navbar.php";
    require "dbconn.php";

    //Need to do username here
    ?>
    <main class="blog-posts">
        <button class="create-post-button" onclick="window.location.href = 'create.php';">
            <img class="create-post-icon" src="images/pen-paper-icon.png" />Create Post
        </button>

        <?php
        $query = "SELECT * from blogPost WHERE archived = \"0\"";

        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<article class=\"blog-post\">";
                echo "<div class=\"blog-post-text\">";
                echo "<h2>" . $row["title"] . "</h2>";
                echo "<h3>" . $row["post_date"] . "</h3>";
                echo "<p>" . $row["post_body"] . "</p>";
                echo "</div>";
                echo "<img class=\"blog-post-image\" src=\"" . $row["post_image"] . "\">";
                echo "</article>";
            }
        }
        ?>
    </main>
</body>

</html>