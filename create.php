<?php
session_start();
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
    ?>
    <main>
        <article class="post-creation">
            <h1>Create post</h1>
            <form name="create-form" method="post" action="create_post.php">
                <label for="post-title">Title (70 characters maximum):</label>
                <br />
                <input type="text" id="post-title" name="post-title" maxlength="70" size="40" onchange="updateTitle()" required />
                <br />

                <label for="post-body">Body:</label>
                <br />
                <textarea class="post-body" id="post-body" name="post-body" rows="15" cols="100" onchange="updatePostBody()" required></textarea>
                <br />

                <label for="post-image">Movie Poster URL:</label>
                <br />
                <input type="text" id="post-image" name="post-image" maxlength="500" size="60" onchange="updateImage()"/>
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
                <h3 id="author-preview"><?php if (isset($_SESSION["username"])) { echo $_SESSION["username"];} ?></h3>
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
            <img class="image-preview" id="image-preview" src="https://s.studiobinder.com/wp-content/uploads/2019/06/Movie-Poster-Template-Movie-Credits-StudioBinder.jpg"/>
        </article>
    </main>

    <script src="js/create.js"></script>
</body>

</html>