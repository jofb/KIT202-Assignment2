<?php

define("DB_HOST", "localhost"); // Host
define("DB_NAME", "jtwylde"); // DB Name
define("DB_USER", "jtwylde"); // DB Username
define("DB_PASS", "25530f6bfd94"); // DB Password

$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conn) {
    // Something went wrong...
    echo "Error: Unable to connect to database.<br>";
    echo "Debugging errno: " . mysqli_connect_errno() . "<br>";
    echo "Debugging error: " . mysqli_connect_error() . "<br>";
    exit;
}
