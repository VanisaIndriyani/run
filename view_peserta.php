<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}
include 'db_connect.php';

$id = $_GET['id'] ?? null;
$source = $_GET['source'] ?? 'individual';
$table = ($source === 'group') ? 'group_participants' : 'participants';

if (!$id) {
    die("ID tidak sah.");
}

// Fetch Data
$sql = "SELECT * FROM $table WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Peserta tidak dijumpai.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Peserta - Admin</title>
    <link rel="stylesheet" href="style_admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="sidebar-overlay"></div>
    <div class="wrapper">
        <nav class="sidebar">
            <div class="sidebar-header">
                <img src="img/logo.jpg" alt="Logo" class="sidebar-logo">
                <h4 style="margin: 10px 0 0;">Admin Panel</h4>
            </div>
            <ul class="sidebar-menu">
                <li><a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="admin_individu.php" class="<?php echo ($source !== 'group') ? 'active' : ''; ?>"><i class="fas fa-user"></i> Daftar Individu</a></li>
                <li><a href="admin_berkumpul.php" class="<?php echo ($source === 'group') ? 'active' : ''; ?>"><i class="fas fa-users"></i> Daftar Berkelompok</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Keluar</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <div class="content-header">
                <button class="menu-toggle"><i class="fas fa-bars"></i></button>
                <div style="flex:1;">
                    <h2 class="content-title">Lihat Maklumat Peserta</h2>
                </div>
                <div>
                    <a href="edit_peserta.php?id=<?php echo $id; ?>&source=<?php echo $source; ?>" class="btn-sm btn-warning" style="margin-right: 10px;"><i class="fas fa-edit"></i> Edit</a>
                    <a href="<?php echo ($source === 'group') ? 'admin_berkumpul.php' : 'admin_individu.php'; ?>" class="btn-sm btn-secondary">&larr; Kembali</a>
                </div>
            </div>

            <div class="card">
                <form>
                    <h3 style="margin-bottom: 20px; color: #003366; border-bottom: 2px solid #eee; padding-bottom: 10px;">Maklumat Peribadi</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Penuh</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['nama_penuh']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>No. IC / Passport</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['ic_number']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jantina</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['jantina']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Umur</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['umur']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kaum</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['race'] ?? '-'); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Agama</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['agama'] ?? '-'); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>No. Telefon</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['no_telefon'] ?? '-'); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Sekolah (Jika Pelajar)</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['nama_sekolah'] ?? '-'); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kod Sekolah</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['kod_sekolah'] ?? '-'); ?>" readonly>
                        </div>
                    </div>

                    <h3 style="margin-top: 30px; margin-bottom: 20px; color: #003366; border-bottom: 2px solid #eee; padding-bottom: 10px;">Maklumat Kecemasan</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Waris</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['ec_name'] ?? '-'); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>No. Telefon Waris</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['ec_number'] ?? '-'); ?>" readonly>
                        </div>
                    </div>

                    <h3 style="margin-top: 30px; margin-bottom: 20px; color: #003366; border-bottom: 2px solid #eee; padding-bottom: 10px;">Maklumat Larian</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Kategori Jarak</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['distance']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Saiz Baju</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['tshirt_size']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jenis Baju</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['tshirt_type']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tarikh Daftar</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['reg_date']); ?>" readonly>
                        </div>
                    </div>

                    <h3 class="section-header">Maklumat Pembayaran</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Kaedah Bayaran</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['payment_method'] ?? '-'); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Status Bayaran</label>
                            <?php 
                                $status = isset($row['payment_status']) ? $row['payment_status'] : 'Pending';
                                $statusClass = ($status == 'Berjaya') ? 'status-success' : 'status-pending';
                            ?>
                            <div class="mt-1">
                                <span class="status-badge <?php echo $statusClass; ?>"><?php echo htmlspecialchars($status); ?></span>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($row['payment_proof'])): ?>
                        <div class="form-group mt-3">
                            <label>Bukti Pembayaran / ID Transaksi</label>
                            <?php 
                                $proof = $row['payment_proof'];
                                $is_file = false;
                                // Check if it looks like a file (has extension and exists in uploads)
                                if (preg_match('/\.(jpg|jpeg|png|pdf)$/i', $proof)) {
                                    $is_file = true;
                                }
                            ?>
                            
                            <?php if ($is_file): ?>
                                <div class="mt-1">
                                    <a href="uploads/<?php echo htmlspecialchars($proof); ?>" target="_blank" class="btn-sm btn-info">
                                        <i class="fas fa-image"></i> Lihat Bukti (Fail)
                                    </a>
                                </div>
                            <?php else: ?>
                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($proof); ?>" readonly>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </form>
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
