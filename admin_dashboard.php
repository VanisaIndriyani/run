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
    <div class="sidebar-overlay"></div>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <img src="img/logo.jpg" alt="Logo" class="sidebar-logo">
                <h4 class="sidebar-title">Admin Panel</h4>
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
                <button class="menu-toggle"><i class="fas fa-bars"></i></button>
                <div>
                    <h2 class="content-title">Dashboard Overview</h2>
                    <p class="text-muted subtitle">Selamat Datang, <strong><?php echo $_SESSION['admin_username']; ?></strong></p>
                </div>
            </div>

            <div class="card">
                <h3 class="card-title">Statistik Pendaftaran</h3>
                
                <div class="dashboard-stats">
                    <!-- Total Participants -->
                    <div class="dashboard-stat-card stat-card-blue">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h2><?php echo $total; ?></h2>
                            <p>Jumlah Peserta</p>
                        </div>
                    </div>

                    <!-- Individual (Clickable) -->
                    <a href="admin_individu.php" class="dashboard-stat-card stat-card-green">
                        <div class="stat-icon">
                            <i class="fas fa-running"></i>
                        </div>
                        <div class="stat-info">
                            <h2><?php echo $count_indiv; ?></h2>
                            <p>Peserta Individu</p>
                        </div>
                        <i class="fas fa-arrow-right arrow-icon"></i>
                    </a>

                    <!-- Group (Clickable) -->
                    <a href="admin_berkumpul.php" class="dashboard-stat-card stat-card-orange">
                        <div class="stat-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="stat-info">
                            <h2><?php echo $count_group; ?></h2>
                            <p>Peserta Berkelompok</p>
                        </div>
                        <i class="fas fa-arrow-right arrow-icon"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        const toggle = document.querySelector('.menu-toggle');

        if(toggle) {
            toggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        }
    </script>
</body>
</html>
