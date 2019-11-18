<?php

// Create connection
function connect() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SimpleFotoFilm";
    return $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

?>