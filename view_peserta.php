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
    <style>
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        .full-width {
            grid-column: span 2;
        }
        .form-control {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
        @media(max-width: 600px) { .form-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="wrapper">
        <nav class="sidebar">
            <div class="sidebar-header">
                <img src="img/logo.jpg" alt="Logo" class="sidebar-logo">
                <h4 style="margin: 10px 0 0;">Admin Panel</h4>
            </div>
            <ul class="sidebar-menu">
                <li><a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="admin_individu.php"><i class="fas fa-user"></i> Daftar Individu</a></li>
                <li><a href="admin_berkumpul.php"><i class="fas fa-users"></i> Daftar Berkelompok</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Keluar</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <div class="content-header">
                <h2 class="content-title">Lihat Maklumat Peserta</h2>
                <div>
                    <a href="edit_peserta.php?id=<?php echo $id; ?>&source=<?php echo $source; ?>" class="btn-sm" style="background: #ffc107; color: #000; margin-right: 10px;"><i class="fas fa-edit"></i> Edit</a>
                    <a href="<?php echo ($source === 'group') ? 'admin_berkumpul.php' : 'admin_individu.php'; ?>" class="btn-sm" style="background: #6c757d;">&larr; Kembali</a>
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
                    </div>

                    <h3 style="margin: 30px 0 20px; color: #003366; border-bottom: 2px solid #eee; padding-bottom: 10px;">Kategori & Baju</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Kategori Larian</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['distance']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jenis Baju</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['tshirt_type']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Saiz Baju</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['tshirt_size']); ?>" readonly>
                        </div>
                    </div>

                    <h3 style="margin: 30px 0 20px; color: #003366; border-bottom: 2px solid #eee; padding-bottom: 10px;">Maklumat Kecemasan</h3>
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
                    <h3 style="margin: 30px 0 20px; color: #003366; border-bottom: 2px solid #eee; padding-bottom: 10px;">Maklumat Pembayaran</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Medium Bayaran</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['payment_method']); ?>" readonly>
                        </div>
                        <div class="form-group full-width">
                            <label>Bukti Pembayaran</label>
                            <div style="margin-top: 10px; border: 1px solid #ddd; padding: 10px; border-radius: 5px; background: #fff;">
                                <?php if (!empty($row['payment_proof'])): ?>
                                    <?php 
                                        $file_ext = pathinfo($row['payment_proof'], PATHINFO_EXTENSION);
                                        if (in_array(strtolower($file_ext), ['jpg', 'jpeg', 'png', 'gif'])): 
                                    ?>
                                        <img src="uploads/<?php echo htmlspecialchars($row['payment_proof']); ?>" alt="Bukti Pembayaran" style="max-width: 100%; height: auto; max-height: 500px; display: block; margin: 0 auto;">
                                    <?php else: ?>
                                        <a href="uploads/<?php echo htmlspecialchars($row['payment_proof']); ?>" target="_blank" class="btn-sm" style="background: #17a2b8; color: white; text-decoration: none; padding: 10px 20px; display: inline-block;">
                                            <i class="fas fa-file-download"></i> Muat Turun / Lihat Dokumen (<?php echo strtoupper($file_ext); ?>)
                                        </a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <p style="color: #dc3545; font-style: italic;">Tiada bukti pembayaran dimuat naik.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>