<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}
include 'db_connect.php';

// Fetch group participants with group count
$sql = "SELECT gp1.*, 
       (SELECT COUNT(*) FROM group_participants gp2 WHERE gp2.payment_proof = gp1.payment_proof AND gp1.payment_proof != '') as group_count 
       FROM group_participants gp1 
       ORDER BY reg_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berkelompok - Admin</title>
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
                <h4 style="margin: 10px 0 0;">Admin Panel</h4>
            </div>
            <ul class="sidebar-menu">
                <li><a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="admin_individu.php"><i class="fas fa-user"></i> Daftar Individu</a></li>
                <li><a href="admin_berkumpul.php" class="active"><i class="fas fa-users"></i> Daftar Berkelompok</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Keluar</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-header">
                <button class="menu-toggle"><i class="fas fa-bars"></i></button>
                <div style="flex:1;">
                    <h2 class="content-title">Daftar Peserta Berkelompok</h2>
                </div>
                <a href="print_group_list.php" class="btn-sm"><i class="fas fa-print"></i> Cetak PDF</a>
            </div>

            <div class="card">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>BIL</th>
                                <th>NAMA PENUH</th>
                                <th>NO. KAD PENGENALAN</th>
                                <th>NO. TEL</th>
                                <th>JARAK LARIAN</th>
                                <th>JUMLAH PESERTA</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php $i = 1; while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_penuh']); ?></td>
                                    <td><?php echo htmlspecialchars($row['ic_number']); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_telefon']); ?></td>
                                    <td><?php echo htmlspecialchars($row['distance']); ?></td>
                                    <td style="text-align:center; font-weight:bold;">
                                        <?php echo htmlspecialchars($row['group_count']); ?>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <a href="view_peserta.php?id=<?php echo $row['id']; ?>&source=group" class="btn-action btn-view" title="Lihat"><i class="fas fa-eye"></i></a>
                                        <a href="edit_peserta.php?id=<?php echo $row['id']; ?>&source=group" class="btn-action btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="print_receipt.php?id=<?php echo $row['id']; ?>&source=group" target="_blank" class="btn-action btn-print" title="Cetak Resit"><i class="fas fa-file-pdf"></i></a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" style="text-align:center;">Tiada rekod dijumpai.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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