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




                <h1>Changes made to home page to replace the placeholder posts with posts from database.</h1>
                <p>
                    Our group made a create_post.php file that inserts new blog posts into the database and will
                    display them in reverse chronological order on the Home page. When a new post is sumbitted, the 
                    oldest post on the Home Page is archived.
                </p>
            </article>
            <article class="about-response-item about-response-password">
                <h1> HTTP method used to submit the login and registration data to the server and explain why you
chose the method you did.</h1>
                <p>
                    .........
                </p>
            </article>
            <article class="about-response-item about-response-registration">
                <h1> Explain how user roles are handled on your blog and how pages are restricted to users of the appropriate role.</h1>
                <p>
                    ..........
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
                <h1>Additional Features added to the blog</h1>
                <p>
                    Authors and Members are able to view and comment on posts on the Home page.
                    Visitors are only able to view comments........

                    

                .................
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