<?php
$servername = "localhost";

// Semak adakah kita berada di localhost atau live server
if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1') {
    // Tetapan Localhost (Laragon/XAMPP)
    $username = "root";
    $password = "";
    $dbname = "run_for_peace";
} else {
    // Tetapan Hosting (Sila ubah ini mengikut hosting anda)
    $username = "bitubimy_izsaa";
    $password = "jokiizsaa200504";
    $dbname = "bitubimy_run";
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>