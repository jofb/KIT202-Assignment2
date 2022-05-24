<?php

session_start();

require "dbconn.php";

$email = htmlspecialchars($_POST["email"]);
$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);

$sanitisedEmail = $conn->real_escape_string($email);
$sanitisedUser = $conn->real_escape_string($username);
$sanitisedPass = $conn->real_escape_string($password);


$hashedPassword = crypt($sanitisedPass, '$5$shrek');

//default to member role
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
    //23000 is the sql error code for same primary key
    if($e->getSqlState() == "23000") {
        //$invalidRegister = true;
        header('Location: login.php?invalid&user=' . $sanitisedUser . "&email=" . $sanitisedEmail);
    }
}
