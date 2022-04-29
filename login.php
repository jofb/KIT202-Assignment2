<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <!-- Font load -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&family=Poppins:wght@100;300;400;600;700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="images/camera.png" type="image/x-icon" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/login.css" />

    <script src="js/navbar.js" defer></script>
</head>

<body>
    <?php
    require "navbar.php";
    ?>
    <main>
        <form class="login-form" name="register-login-form" novalidate>
            <h1 class="form-title">Login</h1>
            <!-- Register email -->
            <input type="email" name="email" id="email" placeholder="Email" hidden />
            <input type="text" name="username" id="username" placeholder="Username" />
            <input type="password" name="password" id="password" placeholder="Password" />
            <!-- Register confirm passwrod -->
            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" hidden />
            <p class="password-policy" hidden>
                Password must be 8+ characters and contain the following:
                <br />
                special character, number, lowercase letter, uppercase
                letter
            </p>
            <p class="error-message" style="color: red"></p>
            <input type="submit" value="Sign In" class="login-submit" name="submit" />
            <button class="register-button" type="button" name="registerButton">
                No Account? Register Here
            </button>
        </form>
    </main>

    <script src="js/register.js"></script>
</body>

</html>