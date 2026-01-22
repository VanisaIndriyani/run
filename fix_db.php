<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "run_for_peace";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$columns_to_add = [
    "kaum" => "VARCHAR(50) NOT NULL AFTER umur",
    "distance" => "VARCHAR(10) NOT NULL AFTER no_telefon",
    "tshirt_size" => "VARCHAR(10) NOT NULL AFTER distance",
    "tshirt_type" => "VARCHAR(10) NOT NULL AFTER tshirt_size",
    "payment_method" => "VARCHAR(50) DEFAULT NULL AFTER ec_number",
    "payment_proof" => "VARCHAR(255) DEFAULT NULL AFTER payment_method"
];

foreach ($columns_to_add as $col => $def) {
    $check = $conn->query("SHOW COLUMNS FROM participants LIKE '$col'");
    if ($check->num_rows == 0) {
        $sql = "ALTER TABLE participants ADD COLUMN $col $def";
        if ($conn->query($sql) === TRUE) {
            echo "Added column: $col<br>";
        } else {
            echo "Error adding $col: " . $conn->error . "<br>";
        }
    } else {
        echo "Column $col already exists.<br>";
    }
}

$conn->close();
echo "Database update completed.";
?>
