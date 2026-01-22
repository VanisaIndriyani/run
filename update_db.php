<?php
include 'db_connect.php';

// Function to check if column exists
function columnExists($conn, $table, $column) {
    $result = $conn->query("SHOW COLUMNS FROM $table LIKE '$column'");
    return $result->num_rows > 0;
}

$columns = [
    "saiz_baju" => "VARCHAR(10)",
    "jarak_larian" => "VARCHAR(10)",
    "telegram_joined" => "TINYINT(1) DEFAULT 0",
    "payment_method" => "VARCHAR(50)"
];

foreach ($columns as $col => $def) {
    if (!columnExists($conn, "participants", $col)) {
        $sql = "ALTER TABLE participants ADD COLUMN $col $def";
        if ($conn->query($sql) === TRUE) {
            echo "Added column $col.<br>";
        } else {
            echo "Error adding column $col: " . $conn->error . "<br>";
        }
    } else {
        echo "Column $col already exists.<br>";
    }
}

$conn->close();
echo "Database update completed.";
?>