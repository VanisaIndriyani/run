<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}
include 'db_connect.php';

// Count participants
$sql_indiv = "SELECT COUNT(*) as count FROM participants WHERE registration_type = 'Individual'";
$res_indiv = $conn->query($sql_indiv);
$count_indiv = $res_indiv->fetch_assoc()['count'];

$sql_group = "SELECT COUNT(*) as count FROM group_participants";
$res_group = $conn->query($sql_group);
$count_group = $res_group->fetch_assoc()['count'];

$total = $count_indiv + $count_group;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Run For Peace 2026</title>
    <link rel="stylesheet" href="style_admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <img src="img/logo.jpg" alt="Logo" class="sidebar-logo">
                <h4 style="margin: 10px 0 0;">Admin Panel</h4>
            </div>
            <ul class="sidebar-menu">
                <li><a href="admin_dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="admin_individu.php"><i class="fas fa-user"></i> Daftar Individu</a></li>
                <li><a href="admin_berkumpul.php"><i class="fas fa-users"></i> Daftar Berkelompok</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Keluar</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-header">
                <h2 class="content-title">Dashboard Overview</h2>
                <span>Selamat Datang, <strong><?php echo $_SESSION['admin_username']; ?></strong></span>
            </div>

            <div class="card">
                <h3>Statistik Pendaftaran</h3>
                <div style="display: flex; gap: 2rem; margin-top: 1rem; flex-wrap: wrap;">
                    <div style="flex: 1; background: #e3f2fd; padding: 1.5rem; border-radius: 10px; text-align: center;">
                        <i class="fas fa-users fa-3x" style="color: #0069d9; margin-bottom: 10px;"></i>
                        <h2><?php echo $total; ?></h2>
                        <p>Jumlah Peserta</p>
                    </div>
                    <div style="flex: 1; background: #e8f5e9; padding: 1.5rem; border-radius: 10px; text-align: center;">
                        <i class="fas fa-user fa-3x" style="color: #2e7d32; margin-bottom: 10px;"></i>
                        <h2><?php echo $count_indiv; ?></h2>
                        <p>Individu</p>
                    </div>
                    <div style="flex: 1; background: #fff3e0; padding: 1.5rem; border-radius: 10px; text-align: center;">
                        <i class="fas fa-users-cog fa-3x" style="color: #ef6c00; margin-bottom: 10px;"></i>
                        <h2><?php echo $count_group; ?></h2>
                        <p>Berkelompok</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>