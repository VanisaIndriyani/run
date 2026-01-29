<?php
include 'db_connect.php';

// Add payment_status column to participants table
$sql1 = "SHOW COLUMNS FROM participants LIKE 'payment_status'";
$result1 = $conn->query($sql1);
if ($result1->num_rows == 0) {
    $sql = "ALTER TABLE participants ADD COLUMN payment_status VARCHAR(50) DEFAULT 'Pending'";
    if ($conn->query($sql) === TRUE) {
        echo "Column payment_status added to participants table successfully.<br>";
        // Update existing records with payment_proof to 'Berjaya'
        $conn->query("UPDATE participants SET payment_status = 'Berjaya' WHERE payment_proof != ''");
    } else {
        echo "Error adding column to participants: " . $conn->error . "<br>";
    }
} else {
    echo "Column payment_status already exists in participants table.<br>";
}

// Add payment_status column to group_participants table
$sql2 = "SHOW COLUMNS FROM group_participants LIKE 'payment_status'";
$result2 = $conn->query($sql2);
if ($result2->num_rows == 0) {
    $sql = "ALTER TABLE group_participants ADD COLUMN payment_status VARCHAR(50) DEFAULT 'Pending'";
    if ($conn->query($sql) === TRUE) {
        echo "Column payment_status added to group_participants table successfully.<br>";
        // Update existing records with payment_proof to 'Berjaya'
        $conn->query("UPDATE group_participants SET payment_status = 'Berjaya' WHERE payment_proof != ''");
    } else {
        echo "Error adding column to group_participants: " . $conn->error . "<br>";
    }
} else {
    echo "Column payment_status already exists in group_participants table.<br>";
}

$conn->close();
?>
