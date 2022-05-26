<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About</title>
    <!-- Font load -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&family=Poppins:wght@100;300;400;600;700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="images/camera.png" type="image/x-icon" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/navbar.css?ts=<?= time() ?>" />
    <link rel="stylesheet" href="css/style.css?ts=<?= time() ?>" />
    <link rel="stylesheet" href="css/about.css?ts=<?= time() ?>" />

    <script src="js/navbar.js" defer></script>
</head>

<body>
    <?php
    require "navbar.php";
    ?>
    <main class="about-container">
        <section class="about-responses">
            <article class="about-response-item about-response-theme">
                <h1>Home Page Changes.</h1>
                <p>
                    Gone are all the placeholder posts, as the age of php is upon us. In place of all of the repetitive
                    HTML is a for loop that loops through all of the blog posts in the database which are not flagged
                    as archived. We echo out the appropriate HTML, adding in the database data as needed.
                </p>
            </article>
            <article class="about-response-item about-response-password">
                <h1>HTTP Methods Chosen For Login/Registration</h1>
                <p>
                    For both login and registration we used the POST method. This was chosen as we did not want the submitted data
                    shown in the GET request. GET is a lot less secure than POST and is better for things like post IDs or usernames.
                    It is not suited for passwords. However, we do use GET to relay an invalid registration back to the client, that request
                    contains the username and email that the user may have tried to register with. This way, we can fill the form back in 
                    so that the user doesn't have to enter them again on an invalid registration. 
                </p>
            </article>
            <article class="about-response-item about-response-registration">
                <h1>User Roles</h1>
                <p>
                    There are 2 roles on the website: Member and Author. When the user is not logged into an account they are
                    considered a Visitor. When a user logs in we set the session role variable to their appropriate role. </br>
                    At the start of every page is a check to see if the user is allowed to access that page given their current sessions role.
                    If they aren't, they are returned to the home page. </br>
                    Currently everyone can view the 'Home', 'About', 'Comments' and 'Login' pages. Members and Authors can access the archive and
                    write comments. However only Authors can create and edit posts.
                </p>
            </article>
            <!-- References -->
            <article class="about-response-item about-response-references">
                <h1>References</h1>
                <p>
                <h3>Font:</h3>
                <a href="https://fonts.google.com/specimen/Poppins">
                    Poppins Google Font
                </a>
                <h3>Images:</h3>
                <a href="https://www.onlinewebfonts.com/icon/466053">
                    Create Post Icon
                </a>
                <a href="http://clipart-library.com/img/950228.jpg">
                    Movie Camera Icon
                </a>
                <a href="https://img.favpng.com/24/18/5/film-reel-cinema-png-favpng-xbmWW1LM6mx1zXMf3LAhMhYmm.jpg">
                    Film Reel Image
                </a>
                <a href="https://www.imdb.com/title/tt1877830/">
                    The Batman Poster
                </a>
                <a href="https://www.imdb.com/title/tt10838180/">
                    Matrix: Resurrections Poster
                </a>
                <a href="https://www.imdb.com/title/tt7097896/">
                    Venom Poster
                </a>
                <a href="https://www.imdb.com/title/tt2382320/">
                    No Time to Die Poster
                </a>
                <a href="https://www.studiobinder.com/blog/movie-poster-credits-template/">
                    Generic Movie Posters
                </a>
                <h3>Code:</h3>
                <a href="https://www.30secondsofcode.org/css/s/hover-underline-animation">
                    Hover underline animation
                </a>
                <a href="https://owasp.org/www-community/password-special-characters">
                    Password special characters
                </a>
                <a href="https://cssgradient.io/">
                    CSS gradient generator
                </a>
                </p>
            </article>
            <article class="about-response-item about-response-functionality">
                <h1>Additional Features Added to the Blog</h1>
                <p>
                    <b>Images: </b>When creating posts the user can submit an image URL which will be uploaded to the database and attached to the blog 
                    post. </br>
                    <b>Edit post: </b>Posts can be edited by loading a variation of the 'create post' page and running an UPDATE command instead of INSERT. The Post ID is supplied through GET. Posts can only be edited by their author.</br>
                    <b>Commenting: </b> Each post now has its own dedicated page where users can add comments that will be stored on the database
                    . Anyone can view comments, however only members and authors can write them. Post IDs are supplied in GET and comments are updated through POST.</br>
                    <b>Additionally</b>, new buttons have been added to the posts on the Home page, which lead to Comments and Edit Post (if the user is the author of that post).
                </p>
            </article>

            <article class="about-response-item about-response-student">
                <h1>Authors</h1>
                <h3>Finlay Delanty <span>(441586)</span></h3>
                <h3>Jordan Wylde-Browne <span>(444691)</span></h3>
                <h3>Jonathon Doonan <span>(451791)</span></h3>
                <span>(each 33% contribution)</span>
            </article>
        </section>
    </main>
</body>

</html>