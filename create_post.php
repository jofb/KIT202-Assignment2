<?php
    session_start();
    
    require "dbconn.php";

    $newTitle = htmlspecialchars($_POST["post-title"]);
    $newPost = $_SESSION["username"];
    $newAuthor = htmlspecialchars($_SESSION["username"]);
    
    $command = "INSERT INTO blogPost (username, title, post_body)
    VALUES ('$newAuthor', '$newTitle', '$newPost');";

    if ($conn->query($command) === TRUE) {
        echo "New post added";
    } else {
        echo "Error: " . $command . "<br>" . $conn->error;
    }

    $conn->close();
?>