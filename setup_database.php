<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "run_for_peace";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select database
$conn->select_db($dbname);

// SQL to create table
$sql = "CREATE TABLE IF NOT EXISTS participants (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_penuh VARCHAR(255) NOT NULL,
    ic_number VARCHAR(20) NOT NULL,
    jantina VARCHAR(10) NOT NULL,
    umur INT(3) NOT NULL,
    agama VARCHAR(50) NOT NULL,
    no_telefon VARCHAR(20) NOT NULL,
    nama_sekolah VARCHAR(255),
    ec_name VARCHAR(255) NOT NULL,
    ec_number VARCHAR(20) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'participants' created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
echo "Setup completed. <a href='form_individu.php'>Go to Registration Form</a>";
?>