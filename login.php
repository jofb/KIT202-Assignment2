<?php
session_start();

require "dbconn.php";

$invalidLogin = false;
$invalidRegister = false;

//Same username case, set invalid register to true for error message
if(isset($_GET["invalid"])) {
    $invalidRegister = true;
}

//If username and password are in POST, try and login
if(isset($_POST["username"]) && isset($_POST["password"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    //If authentication is successful, move to main page
    if(authenticate($username, $password)) {
        $_SESSION["username"] = $username;
        header('Location: index.php');
    } else {
        $invalidLogin = true;
    }
}

//Authenticates user and password against database after sanitisation
//Returns false when username or password don't match
function authenticate($user, $pass) {
    global $conn;

    $sanitisedPass = $conn->real_escape_string($pass);
    $sanitisedUser = $conn->real_escape_string($user);

    $query = "SELECT username, password, role FROM User WHERE username = '$sanitisedUser'";
    $result = $conn->query($query);

    if($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        //if password is successfully verified, set session role and return true
        if(password_verify($sanitisedPass, $row["password"])) {
            $_SESSION["role"] = $row["role"];
            return true;
        }
    }

    return false;
}
?>

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
    <link rel="stylesheet" href="css/navbar.css?ts=<?= time() ?>" />
    <link rel="stylesheet" href="css/style.css?ts=<?= time() ?>" />
    <link rel="stylesheet" href="css/login.css?ts=<?= time() ?>" />

    <script src="js/navbar.js" defer></script>
</head>

<body>
    <?php
    require "navbar.php";
    ?>
    <main>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="login-form" name="register-login-form" novalidate>
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

            <!-- Error message -->
            <p class="error-message" style="color: red">
                <?php
                //Invalid login error message
                if($invalidLogin) {
                    echo "Username or Password is invalid";
                }
                ?>
            </p>

            <input type="submit" value="Sign In" class="login-submit" name="submit" />
            <button class="register-button" type="button" name="registerButton">
                No Account? Register Here
            </button>
        </form>
        <?php

        ?>
    </main>

    <script src="js/register.js"></script>
    <?php 
        //If there is an invalid register, update the form with old username/email and report error
        if($invalidRegister) {
            $user = $_GET["user"];
            $email = $_GET["email"];
            //Updating form via javascript
            echo "
            <script> 
            registerButtonChange(); 
            updateRegisterForm('$user', '$email');
            </script>";
        }
    ?>
</body>

</html>