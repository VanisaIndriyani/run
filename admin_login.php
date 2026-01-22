<?php
session_start();
include 'db_connect.php';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin_dashboard.php");
    exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_username'] = $row['username'];
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = "Kata laluan tidak sah.";
        }
    } else {
        $error = "Nama pengguna tidak ditemui.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Run For Peace 2026</title>
    <link rel="stylesheet" href="style_admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <img src="img/logo.jpg" alt="Logo" class="login-logo">
            <h2 class="login-title">Admin Login</h2>
            
            <?php if ($error): ?>
                <div class="error-msg">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input type="text" name="username" class="form-control" required placeholder="Masukkan username">
                </div>
                <div class="form-group">
                    <label>Kata Laluan</label>
                    <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
                </div>
                <button type="submit" class="btn-login">Log Masuk</button>
            </form>
            <div style="margin-top: 1rem;">
                <a href="index.php" style="color: #666; font-size: 0.9rem; text-decoration: none;">&larr; Kembali ke Laman Utama</a>
            </div>
        </div>
    </div>
</body>
</html>