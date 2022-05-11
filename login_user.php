<?php
session_start();

require "dbconn.php";

$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);

$query = "SELECT username, password, role from user WHERE username=\"$username\"";

$result = $conn->query($query);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["password"] == $password) {
            //successfully log in
            setSessionUser($row["username"], $row["role"]);
            header('Location: index.php');
        } else {
            //password doesnt match
            header('Location: login.php?pass=failed');
        }
    } else {
        //username doesnt exit
        header("Location: login.php?user=not_found");
    }
}

function setSessionUser($user, $role)
{
    $_SESSION["username"] = $user;
    $_SESSION["role"] = $role;
}
