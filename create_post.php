<?php
    require "dbconn.php";

    $newTitle = $_POST["post-title"];
    $newPost = $_POST["post-body"];
    
    $command = "INSERT INTO blogPost (title, post_body)
    VALUES ('$newTitle', '$newPost');";

    if ($conn->query($command) === TRUE) {
        echo "New post added";
    } else {
        echo "Error: " . $command . "<br>" . $conn->error;
    }

    $conn->close();
?>