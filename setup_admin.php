<?php
include 'db_connect.php';

// 1. Create Admins Table
$sql_admins = "CREATE TABLE IF NOT EXISTS admins (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_admins) === TRUE) {
    echo "Table 'admins' created successfully or already exists.<br>";
} else {
    echo "Error creating table 'admins': " . $conn->error . "<br>";
}

// 2. Add registration_type to participants if not exists
$check_col = $conn->query("SHOW COLUMNS FROM participants LIKE 'registration_type'");
if ($check_col->num_rows == 0) {
    $sql_alter = "ALTER TABLE participants ADD COLUMN registration_type VARCHAR(20) NOT NULL DEFAULT 'Individual'";
    if ($conn->query($sql_alter) === TRUE) {
        echo "Column 'registration_type' added to participants.<br>";
    } else {
        echo "Error adding 'registration_type': " . $conn->error . "<br>";
    }
} else {
    echo "Column 'registration_type' already exists.<br>";
}

// 3. Insert Default Admin
$username = "admin";
$password = "password123";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$check_admin = $conn->query("SELECT * FROM admins WHERE username = '$username'");
if ($check_admin->num_rows == 0) {
    $sql_insert = "INSERT INTO admins (username, password) VALUES ('$username', '$hashed_password')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "Default admin created (User: admin, Pass: password123).<br>";
    } else {
        echo "Error creating default admin: " . $conn->error . "<br>";
    }
} else {
    echo "Default admin already exists.<br>";
}

$conn->close();
echo "<br>Setup Admin completed. <a href='admin_login.php'>Go to Login</a>";
?>