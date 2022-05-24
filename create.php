<?php
session_start();
require "dbconn.php"; 

// If loading "Edit Post"
if (isset($_GET["edit"])) {
	   
	$postToEdit = $_GET["edit"];

    $query = "SELECT 
        title, 
        post_body, 
        post_image
        from blogPost WHERE post_id = $postToEdit;";
    $result = $conn->query($query);

    if($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentTitle = $row["title"];
            $currentBody = $row["post_body"];
            $currentImage = $row["post_image"];
    }
    echo "<script>updateAll();</script>";
}

// If page was submitted as an action
if(isset($_POST["post-title"]) && isset($_POST["post-body"])) {

    $newTitle = htmlentities($_POST["post-title"]);
    $newAuthor = $_SESSION["username"];
    $newPost = htmlentities($_POST["post-body"]);
    if (isset($_POST["post-image"])) $newImage = $_POST["post-image"];
    
    // Editing post
    if (isset($_GET["edit"])) {
        $editCommand = "UPDATE blogPost SET title='$newTitle', post_body='$newPost', post_image='$newImage' WHERE post_id=$postToEdit;";

        if ($conn->query($editCommand) === TRUE) {
            header('Location: index.php');
            //header('Location: blogpost.php&post_id=$postToEdit');
        } else {
            echo "Error: " . $command . "<br>" . $conn->error;
        }
    
        $conn->close();

    }
    // Creating post
    else {
        $command = "INSERT INTO blogPost (username, title, post_body, post_image)
        VALUES ('$newAuthor', '$newTitle', '$newPost', '$newImage');";

        if ($conn->query($command) === TRUE) {
            updateArchivedPosts();
            header('Location: index.php');
        } else {
            echo "Error: " . $command . "<br>" . $conn->error;
        }
    
        $conn->close();

    }
    


    
}

function updateArchivedPosts()
{
    global $conn;

    $highestTime = 0;
    $toRemove = 0;

    $postQuery = "SELECT post_id, post_date, archived from blogPost where archived = 0 ORDER BY post_date ASC";
    $result = $conn->query($postQuery);

    if ($result && $result->num_rows > 1) {
        $row = $result->fetch_assoc();
        $toRemove = $row["post_id"];
        $updateQuery = "UPDATE blogPost SET archived = 1 WHERE post_id = '$toRemove';";
        $result = $conn->query($updateQuery);
        if ($result) {
            echo "Updated Blog Posts";
        } else {
            echo "Something went wrong";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Post</title>
    <!-- Font load -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&family=Poppins:wght@100;300;400;600;700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="images/camera.png" type="image/x-icon" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/navbar.css?ts=<?= time() ?>" />
    <link rel="stylesheet" href="css/style.css?ts=<?= time() ?>" />
    <link rel="stylesheet" href="css/create.css?ts=<?= time() ?>" />

    <script src="js/navbar.js" defer></script>
</head>

<body>
    <?php
    require "navbar.php";

    if (!isset($_SESSION["role"]) || $_SESSION["role"] != "Author") {
        header('Location: index.php');
    }
    ?>
    <main>
        <article class="post-creation">
            <h1><?php 
            
            if (isset($_GET["edit"])) {
                echo "Edit post";
            }
            else {
                echo "Create post";
            }

            ?></h1>
            <form name="create-form" method="post" action="<?php $_SERVER["PHP_SELF"]; ?>">
                <label for="post-title">Title (70 characters maximum):</label>
                <br />
                <input type="text" id="post-title" name="post-title" <?php if (isset($_GET["edit"])) echo "value=\"$currentTitle\""; ?> maxlength="70" size="40" onchange="updateTitle()" required />
                <br />

                <label for="post-body">Body:</label>
                <br />
                <textarea class="post-body" id="post-body" name="post-body" rows="15" cols="100" onchange="updatePostBody()" required><?php if (isset($_GET["edit"])) echo "$currentBody"; ?></textarea>
                <br />

                <label for="post-image">Movie Poster URL:</label>
                <br />
                <input type="text" id="post-image" name="post-image" <?php if (isset($_GET["edit"])) echo "value=\"$currentImage\""; ?> maxlength="500" size="60" onchange="updateImage()" />
                <br />

                <div class="buttons">
                    <input type="submit" value="Submit" name="submit" class="create-submit" />
                </div>
            </form>
        </article>


        <article class="post-preview">
            <div class="text-preview">
                <h2 id="title-preview">
                This is a preview of your new post
                </h2>
                <h3 id="author-preview">
                    <?php if (isset($_SESSION["username"])) {
                        echo $_SESSION["username"];
                    }
                    ?>
                </h3>
                <h3 id="date-preview">32nd Septober 2008</h3>
                <p id="body-preview">
                    This is the body of your post. Lorem ipsum dolor sit
                    amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua. Ut enim ad
                    minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure
                    dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                    cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum. Duis aute irure
                    dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                    cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.
                </p>
            </div>
            <!--<div class="placeholder-image"></div>-->
            <img class="image-preview" id="image-preview" src="https://s.studiobinder.com/wp-content/uploads/2019/06/Movie-Poster-Template-Movie-Credits-StudioBinder.jpg" />
        </article>
    </main>

    <script src="js/create.js"></script>
    <?php
    if (isset($_GET["edit"])) {
        echo "<script>updateAll();</script>";
    }
    ?>
</body>

</html>