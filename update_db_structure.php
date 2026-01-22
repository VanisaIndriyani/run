<?php
include 'db_connect.php';

function addColumnIfNotExists($conn, $table, $column, $definition) {
    $check = $conn->query("SHOW COLUMNS FROM $table LIKE '$column'");
    if ($check->num_rows == 0) {
        $sql = "ALTER TABLE $table ADD COLUMN $column $definition";
        if ($conn->query($sql) === TRUE) {
            echo "Column '$column' added successfully.<br>";
        } else {
            echo "Error adding '$column': " . $conn->error . "<br>";
        }
    } else {
        echo "Column '$column' already exists.<br>";
    }
}

$table = "participants";
addColumnIfNotExists($conn, $table, "distance", "VARCHAR(10) NOT NULL DEFAULT '5KM'");
addColumnIfNotExists($conn, $table, "tshirt_size", "VARCHAR(10) NOT NULL");
addColumnIfNotExists($conn, $table, "tshirt_type", "VARCHAR(10) NOT NULL DEFAULT 'Adult'");
addColumnIfNotExists($conn, $table, "race", "VARCHAR(50) NOT NULL DEFAULT 'Melayu'");
addColumnIfNotExists($conn, $table, "payment_method", "VARCHAR(50) NOT NULL DEFAULT ''");
addColumnIfNotExists($conn, $table, "payment_proof", "VARCHAR(255) NOT NULL DEFAULT ''");

$conn->close();
echo "Database updated. <a href='form_individu.php'>Go to Form</a>";
?>
