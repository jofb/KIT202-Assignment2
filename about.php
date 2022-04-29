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
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/about.css" />

    <script src="js/navbar.js" defer></script>
</head>

<body>
    <?php
    require "navbar.php";
    ?>
    <main class="about-container">
        <section class="about-responses">
            <article class="about-response-item about-response-theme">
                <h1>The Theme</h1>
                <p>
                    The theme our group chose for our blog was movie
                    reviews.
                </p>
            </article>
            <article class="about-response-item about-response-password">
                <h1>Password Policy</h1>
                <p>
                    The password policy for our blog requires a minimum
                    password length of 8 characters including at least one
                    special character, one number, and atleast one
                    uppercase/lowercase letter.
                </p>
            </article>
            <article class="about-response-item about-response-registration">
                <h1>The Registration Form</h1>
                <p>
                    The login form is changed using Javascript. By default
                    the additional form elements such as email and confirm
                    password are hidden. They are enabled through the script
                    and the register button.
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
                <h1>Additional Functionality</h1>
                <p>
                    Sticky navigation was added to the navbar for ease of access when a user has scrolled down a page.
                    Navbar buttons were decorated to fit our movie theme.<br><br>

                    The Create Post page features a real-time preview of how your post will appear once submitted, with an accurate date and placeholder image.<br><br>

                    The blog is responsive to different screen sizes. Posts each feature an image to the right of their body text, or beneath the body text when the
                    screen width is below a certain threshold. The about page changes its grid layout on smaller screen sizes.
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