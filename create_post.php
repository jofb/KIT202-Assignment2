<?php
session_start();

$newTitle = htmlspecialchars($_POST["post-title"]);
$newAuthor = $_SESSION["username"];
$newPost = htmlspecialchars($_POST["post-body"]);
$newImage = $_POST["post-image"];

$command = "INSERT INTO blogPost (username, title, post_body, post_image)
    VALUES ('$newAuthor', '$newTitle', '$newPost', '$newImage');";

if ($conn->query($command) === TRUE) {
    updateArchivedPosts();
    header('Location: index.php');
} else {
    echo "Error: " . $command . "<br>" . $conn->error;
}

function updateArchivedPosts()
{
    global $conn;

    $highestTime = 0;
    $toRemove = 0;

    $postQuery = "SELECT post_id, post_date, archived from blogPost where archived = 0 ORDER BY post_date ASC";
    $result = $conn->query($postQuery);

    if ($result && $result->num_rows > 1) {
        $row = $result->fetch_assoc();
        $toRemove = $row["post_id"];

        $updateQuery = "UPDATE blogPost SET archived = 1 WHERE post_id = '$toRemove';";

        $result = $conn->query($updateQuery);
        if ($result) {
            echo "Updated Blog Posts";
        } else {
            echo "Something went wrong";
        }
    }
}

$conn->close();
