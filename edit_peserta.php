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

$msg = "";

// Handle Update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_penuh'];
    $ic = $_POST['ic_number'];
    $jantina = $_POST['jantina'];
    $umur = $_POST['umur'];
    $kaum = $_POST['race'];
    $agama = $_POST['agama'];
    $tel = $_POST['no_telefon'];
    $sekolah = $_POST['nama_sekolah'];
    $ec_name = $_POST['ec_name'];
    $ec_number = $_POST['ec_number'];
    $distance = $_POST['distance'];
    $size = $_POST['tshirt_size'];
    $type = $_POST['tshirt_type'];

    $sql_update = "UPDATE $table SET 
        nama_penuh=?, ic_number=?, jantina=?, umur=?, race=?, agama=?, no_telefon=?, 
        nama_sekolah=?, ec_name=?, ec_number=?, distance=?, tshirt_size=?, tshirt_type=? 
        WHERE id=?";
    
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("sssisssssssssi", $nama, $ic, $jantina, $umur, $kaum, $agama, $tel, $sekolah, $ec_name, $ec_number, $distance, $size, $type, $id);
    
    if ($stmt->execute()) {
        $msg = "<div class='alert success'>Maklumat berjaya dikemaskini.</div>";
    } else {
        $msg = "<div class='alert error'>Ralat: " . $conn->error . "</div>";
    }
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
    <title>Edit Peserta - Admin</title>
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
                <li><a href="admin_individu.php"><i class="fas fa-user"></i> Daftar Individu</a></li>
                <li><a href="admin_berkumpul.php"><i class="fas fa-users"></i> Daftar Berkelompok</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Keluar</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <div class="content-header">
                <button class="menu-toggle"><i class="fas fa-bars"></i></button>
                <div style="flex:1;">
                    <h2 class="content-title">Edit Peserta</h2>
                </div>
                <a href="<?php echo ($source === 'group') ? 'admin_berkumpul.php' : 'admin_individu.php'; ?>" class="btn-sm" style="background: #6c757d;">&larr; Kembali</a>
            </div>

            <div class="card">
                <?php echo $msg; ?>
                <form method="POST">
                    <h3 style="margin-bottom: 20px; color: #003366; border-bottom: 2px solid #eee; padding-bottom: 10px;">Maklumat Peribadi</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Penuh</label>
                            <input type="text" name="nama_penuh" class="form-control" value="<?php echo htmlspecialchars($row['nama_penuh'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>No. IC / Passport</label>
                            <input type="text" name="ic_number" class="form-control" value="<?php echo htmlspecialchars($row['ic_number'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Jantina</label>
                            <select name="jantina" class="form-control">
                                <option value="Lelaki" <?php echo ($row['jantina'] == 'Lelaki') ? 'selected' : ''; ?>>Lelaki</option>
                                <option value="Perempuan" <?php echo ($row['jantina'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Umur</label>
                            <input type="number" name="umur" class="form-control" value="<?php echo htmlspecialchars($row['umur'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Kaum</label>
                            <select name="race" class="form-control">
                                <option value="Melayu" <?php echo ($row['race'] == 'Melayu') ? 'selected' : ''; ?>>Melayu</option>
                                <option value="Cina" <?php echo ($row['race'] == 'Cina') ? 'selected' : ''; ?>>Cina</option>
                                <option value="India" <?php echo ($row['race'] == 'India') ? 'selected' : ''; ?>>India</option>
                                <option value="Lain-lain" <?php echo ($row['race'] == 'Lain-lain') ? 'selected' : ''; ?>>Lain-lain</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" class="form-control">
                                <option value="Islam" <?php echo ($row['agama'] == 'Islam') ? 'selected' : ''; ?>>Islam</option>
                                <option value="Buddha" <?php echo ($row['agama'] == 'Buddha') ? 'selected' : ''; ?>>Buddha</option>
                                <option value="Hindu" <?php echo ($row['agama'] == 'Hindu') ? 'selected' : ''; ?>>Hindu</option>
                                <option value="Kristian" <?php echo ($row['agama'] == 'Kristian') ? 'selected' : ''; ?>>Kristian</option>
                                <option value="Lain-lain" <?php echo ($row['agama'] == 'Lain-lain') ? 'selected' : ''; ?>>Lain-lain</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No. Telefon</label>
                            <input type="text" name="no_telefon" class="form-control" value="<?php echo htmlspecialchars($row['no_telefon'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Sekolah (Jika Pelajar)</label>
                            <input type="text" name="nama_sekolah" class="form-control" value="<?php echo htmlspecialchars($row['nama_sekolah'] ?? ''); ?>">
                        </div>
                    </div>

                    <h3 style="margin: 30px 0 20px; color: #003366; border-bottom: 2px solid #eee; padding-bottom: 10px;">Kategori & Baju</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Kategori Larian</label>
                            <select name="distance" class="form-control">
                                <option value="5KM" <?php echo ($row['distance'] == '5KM') ? 'selected' : ''; ?>>5 KM - Fun Run</option>
                                <option value="10KM" <?php echo ($row['distance'] == '10KM') ? 'selected' : ''; ?>>10 KM - Power Run</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Baju</label>
                            <select name="tshirt_type" class="form-control">
                                <option value="Adult" <?php echo ($row['tshirt_type'] == 'Adult') ? 'selected' : ''; ?>>Dewasa (Unisex)</option>
                                <option value="Kid" <?php echo ($row['tshirt_type'] == 'Kid') ? 'selected' : ''; ?>>Kanak-kanak</option>
                                <option value="Muslimah" <?php echo ($row['tshirt_type'] == 'Muslimah') ? 'selected' : ''; ?>>Muslimah</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Saiz Baju</label>
                            <select name="tshirt_size" class="form-control">
                                <?php
                                $sizes = ['2XS','XS','S','M','L','XL','2XL','3XL','4XL','5XL','6XL','7XL'];
                                foreach($sizes as $s) {
                                    $sel = ($row['tshirt_size'] == $s) ? 'selected' : '';
                                    echo "<option value='$s' $sel>$s</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <h3 style="margin: 30px 0 20px; color: #003366; border-bottom: 2px solid #eee; padding-bottom: 10px;">Maklumat Kecemasan</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Waris</label>
                            <input type="text" name="ec_name" class="form-control" value="<?php echo htmlspecialchars($row['ec_name'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>No. Telefon Waris</label>
                            <input type="text" name="ec_number" class="form-control" value="<?php echo htmlspecialchars($row['ec_number'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div style="margin-top: 30px;">
                        <button type="submit" class="btn-sm btn-success"><i class="fas fa-save"></i> Simpan Perubahan</button>
                    </div>
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