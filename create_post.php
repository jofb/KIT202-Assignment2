<?php
    session_start();
    $_SESSION["username"] = "admin";
    
    require "dbconn.php";

    $newTitle = $_POST["post-title"];
    $newPost = $_POST["post-body"];
    $newAuthor = $_SESSION["username"];
    
    $command = "INSERT INTO blogPost (username, title, post_body)
    VALUES ('$newAuthor', '$newTitle', '$newPost');";

    if ($conn->query($command) === TRUE) {
        echo "New post added";
    } else {
        echo "Error: " . $command . "<br>" . $conn->error;
    }

    $conn->close();
?>