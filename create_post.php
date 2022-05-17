<?php
    session_start();
    
    require "dbconn.php";

    $newTitle = htmlspecialchars($_POST["post-title"]);
    $newAuthor = $_SESSION["username"];
    $newPost = htmlspecialchars($_POST["post-body"]);
    $newImage = $_POST["post-image"];
    
    $command = "INSERT INTO blogPost (username, title, post_body, post_image)
    VALUES ('$newAuthor', '$newTitle', '$newPost', '$newImage');";

    if ($conn->query($command) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $command . "<br>" . $conn->error;
    }

    $conn->close();
?>