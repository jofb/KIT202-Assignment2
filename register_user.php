<?php
//Page for handling registering a user

session_start();

require "dbconn.php";


//Sanitise all inputs
$email = htmlspecialchars($_POST["email"]);
$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);

$sanitisedEmail = $conn->real_escape_string($email);
$sanitisedUser = $conn->real_escape_string($username);
$sanitisedPass = $conn->real_escape_string($password);

//Hash the password
$hashedPassword = crypt($sanitisedPass, '$5$shrek');

//Default to member role
$values = "'$sanitisedUser', '$hashedPassword', 'member', '$sanitisedEmail'";

$query = "INSERT INTO User (username, password, role, email) VALUES ($values);";

//Handle same username case
try {
    $result = $conn->query($query);
    if ($result) {
        //If successfully created new user
        $_SESSION["username"] = $username;
        $_SESSION["role"] = "member";
        header('Location: index.php');
    }
} catch(mysqli_sql_exception $e) {
    //Default behaviour against any MySQL Exception, return back to login
    header('Location: login.php?invalid&user=' . $sanitisedUser . "&email=" . $sanitisedEmail);
}
