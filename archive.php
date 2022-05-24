<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Archive</title>
    <!-- Font load -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&family=Poppins:wght@100;300;400;600;700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="images/camera.png" type="image/x-icon" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/navbar.css?ts=<?= time() ?>" />
    <link rel="stylesheet" href="css/style.css?ts=<?= time() ?>" />
    <link rel="stylesheet" href="css/archive.css?ts=<?= time() ?>" />

    <script src="js/navbar.js" defer></script>
</head>

<body>
    <?php
    require "navbar.php";
    require "dbconn.php";

    if (!isset($_SESSION["role"]) || $_SESSION["role"] == "Visitor") {
        header('Location: index.php');
    }
    ?>
    <main class="archive-posts">

        <?php
        $query = "SELECT title, archived,
    DATE_FORMAT(post_date, \"%d %M %Y\") AS 'DOB'
    from Blog_Post WHERE archived = \"1\"
    ORDER BY post_date DESC;";



        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<article class=\"archive-post\">";
                echo "<h2>" . $row["title"] . "</h2>";
                echo "<h3>" . $row["DOB"] . "</h3>";
                echo "</article>";
            }
        }
        ?>

    </main>
</body>

</html>