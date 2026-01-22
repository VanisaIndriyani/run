<?php
include 'db_connect.php';

$sql = "CREATE TABLE IF NOT EXISTS group_participants (
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
    distance VARCHAR(10) NOT NULL DEFAULT '5KM',
    tshirt_size VARCHAR(10) NOT NULL,
    tshirt_type VARCHAR(10) NOT NULL DEFAULT 'Adult',
    race VARCHAR(50) NOT NULL DEFAULT 'Melayu',
    payment_method VARCHAR(50) NOT NULL DEFAULT '',
    payment_proof VARCHAR(255) NOT NULL DEFAULT '',
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'group_participants' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>