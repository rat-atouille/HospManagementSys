<?php
function connectDB() {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "assign2db";
    
    $connection = mysqli_connect($host, $username, $password, $database);
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $connection;
}

function disconnectDB($connection) {
    mysqli_close($connection);
}
?>
