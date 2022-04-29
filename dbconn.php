<?php

define("DB_HOST", "localhost"); // Leave this line as is
define("DB_NAME", "jtwylde"); // Set this to your username
define("DB_USER", "jtwylde"); // Set this to your username
define("DB_PASS", "25530f6bfd94"); // Set this to your DB password (from mysql_pass.txt)

$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conn) {
    // Something went wrong...
    echo "Error: Unable to connect to database.<br>";
    echo "Debugging errno: " . mysqli_connect_errno() . "<br>";
    echo "Debugging error: " . mysqli_connect_error() . "<br>";
    exit;
}
