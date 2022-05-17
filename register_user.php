<?php
session_start();

require "dbconn.php";

$email = htmlspecialchars($_POST["email"]);
$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);

//default to member role
$values = "'$username', '$password', 'member', '$email'";

$query = "INSERT INTO user (username, password, role, email) VALUES ($values);";

$result = $conn->query($query);
echo $query;

if ($result) {
    //If successfully created new user
    setSessionUser($username, "member");
    header('Location: index.php');
} else {
    echo "Something went wrong with the SQL";
}

function setSessionUser($user, $role)
{
    $_SESSION["username"] = $user;
    $_SESSION["role"] = $role;
}
