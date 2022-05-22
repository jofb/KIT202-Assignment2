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
                    -got rid of each individual post and replaced it with a for loop that loops through all blog
                    posts in the database that have the archived tag flagged false
                    -then we simply echo'ed out the appropriate html, replacing it with the database data as neccessary.
                </p>
            </article>
            <article class="about-response-item about-response-password">
                <h1>HTTP Methods Chosen For Login/Registration</h1>
                <p>
                    -for both login and registration we used post. 
                    -did not want the password from the form visible in the URL so GET is not appropriate here.
                    -however did use GET when an invalid registration is performed, so that the script can retrieve the email and 
                    username entered from the user. This makes it more convenient for the user if they enter an invalid username (one that
                    is already taken.)
                </p>
            </article>
            <article class="about-response-item about-response-registration">
                <h1>User Roles</h1>
                <p>
                    -there are 2 main roles on the website: member and author. When the session is not logged in, the user is
                    considered a visitor. 
                    -when a user logs in we set the session role variable to their appropriate role.
                    -At the start of every php script is a check to see if the user is allowed onto that page given their current 
                    sessions role. if they aren't, they are returned to the home page
                    -this prevents users from accessing pages they should not be able to
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
                    <b>Logout button: </b> When a user is logged into an account, the login button is replaced with a logout button, which resets the session
                    and returns the user to the home page as a fresh visitor. </br>
                    <b>Images: </b>When creating posts the user can submit an image URL which will be uploaded to the database and attached to the blog 
                    post. </br>
                    <b>Registration: </b>When a user tries to register with a username that already exists, the website 
                    will remember the username and email entered via GET, for convenience. </br>
                    -Commenting (?)
                    -Liking (?)

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