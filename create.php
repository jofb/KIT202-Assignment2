<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "Author") {
    header('Location: index.php');
}

require "dbconn.php"; 

// If user is editing a post rather than creating one, change the forms contents to match the post
if (isset($_GET["edit"])) {
	   
	$postToEdit = $_GET["edit"];

    $query = "SELECT 
        title, 
        post_body, 
        post_image,
        username
        from Blog_Post WHERE post_id = $postToEdit;";

    $result = $conn->query($query);

    //If there is a matching post, update the forms contents
    if($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if($row["username"] != $_SESSION["username"]) {
                //Have to be the author of the post!
                header('Location: index.php');
            }
            $currentTitle = $row["title"];
            $currentBody = $row["post_body"];
            $currentImage = $row["post_image"];
    }
}

//If the form was submitted, process the POST contents
if(isset($_POST["post-title"]) && isset($_POST["post-body"])) {

    //Sanitising input
    $newTitle = $conn->real_escape_string(htmlentities($_POST["post-title"]));
    $newAuthor = $_SESSION["username"];
    $newPost = $conn->real_escape_string(htmlentities($_POST["post-body"]));

    //default image
    $newImage = "https://s.studiobinder.com/wp-content/uploads/2019/06/Movie-Poster-Template-Movie-Credits-StudioBinder.jpg";

    //Image is optional!
    if (isset($_POST["post-image"]) && $_POST["post-image"] != "") 
        $newImage = $_POST["post-image"];
    
    //If we're editing the post, use an update query 
    if (isset($_GET["edit"])) {
        $editCommand = "UPDATE Blog_Post SET title='$newTitle', 
        post_body='$newPost', post_image='$newImage' 
        WHERE post_id=$postToEdit;";

        $result = $conn->query($editCommand);

        if ($result) {
            header('Location: index.php');
        } else {
            echo "Error: " . $command . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    //Else, create a new post with INSERT query
    else {

        $command = "INSERT INTO Blog_Post (username, title, post_body, post_image)
        VALUES ('$newAuthor', '$newTitle', '$newPost', '$newImage');";

        $result = $conn->query($command);

        if ($result) {
            //Update archived posts with the oldest one
            updateArchivedPosts();
            header('Location: index.php');
        } else {
            echo "Error: " . $command . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
}

//Removes the oldest post from index.php and flags it as archived
function updateArchivedPosts()
{
    global $conn;

    //Select all posts that aren't archived, sorted by date
    $postQuery = "SELECT post_id, post_date, archived FROM Blog_Post WHERE archived = 0 ORDER BY post_date ASC";
    $result = $conn->query($postQuery);

    //If there are more than 4 posts that aren't archived, update the oldest one (the first in the list)
    if ($result && $result->num_rows > 4) {

        $row = $result->fetch_assoc();
        $toRemove = $row["post_id"];

        $updateQuery = "UPDATE Blog_Post SET archived = 1 WHERE post_id = '$toRemove';";

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
    <title><?php if(isset($_GET["edit"])) echo "Edit"; else echo "Create"; ?> Post</title>
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
    ?>
    <main>
        <article class="post-creation">
            <h1><?php 
            
            if (isset($_GET["edit"])) {
                echo "Edit Post";
            }
            else {
                echo "Create Post";
            }

            ?></h1>
            <form name="create-form" method="post" action="<?php $_SERVER["PHP_SELF"]; ?>">
                <label for="post-title">Title (70 characters maximum):</label>
                <br />
                <input type="text" id="post-title" name="post-title" <?php if (isset($_GET["edit"])) echo "value=\"$currentTitle\"" ?> maxlength="70" size="40" onchange="updateTitle()" required />
                <br />

                <label for="post-body">Body:</label>
                <br />
                <textarea class="post-body" id="post-body" name="post-body" rows="15" cols="100" 
                onchange="updatePostBody()" required><?php 
                if (isset($_GET["edit"])) 
                    echo "$currentBody"; 
                ?></textarea>
                <br />

                <label for="post-image">Movie Poster URL:</label>
                <br />
                <input type="text" id="post-image" name="post-image" 
                <?php
                if (isset($_GET["edit"])) 
                    echo "value=\"$currentImage\"" 
                ?> 
                maxlength="500" size="60" onchange="updateImage()" />
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
    if(isset($_GET["edit"])) {
        echo "<script> updateAll(); </script>";
    }
    ?>
</body>

</html>