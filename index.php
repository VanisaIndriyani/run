<?php
$pageTitle = "Pendaftaran Tangkak Run For Peace 2026";
$buttons = [
    ["text" => "PENDAFTARAN<br>INDIVIDU", "link" => "pendaftaran_individu.php"],
    ["text" => "PENDAFTARAN<br>BERKUMPULAN", "link" => "pendaftaran_berkumpul.php"],
    ["text" => "TREK LARIAN<br>5 KM & 10 KM", "link" => "track_larian.php"],
    ["text" => "ATURCARA", "link" => "tentatif.php"],
    ["text" => "SURAT & MAKLUMAT<br>BERKAITAN", "link" => "surat_maklumat.php"],
    ["text" => "KAUNTER<br>PERTANYAAN", "link" => "pertanyaan.php"]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="style_index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <main class="main-container">
        <div class="content-wrapper">
            <!-- Left Section: Logo and Illustration -->
            <div class="left-section slide-in-left">
                <div class="logo-wrapper">
                    <a href="admin_login.php" style="text-decoration: none;">
                        <img src="img/logo.jpg" alt="Logo Pengakap Daerah Tangkak" class="main-logo">
                    </a>
                    <img src="img/logo2.jpg" alt="Logo Run For Peace" class="main-logo">
                </div>
                <div class="illustration-wrapper">
                    <img src="img/laa.png" alt="Ilustrasi Pelari" class="runners-img">
                </div>
            </div>

            <!-- Right Section: Title and Buttons -->
            <div class="right-section slide-in-right">
                <h1 class="event-title">
                    PENDAFTARAN<br>
                    <span class="highlight">TANGKAK RUN FOR</span><br>
                    PEACE 2026
                </h1>

                <div class="buttons-grid">
                    <?php foreach ($buttons as $btn): ?>
                    <a href="<?php echo $btn['link']; ?>" class="action-btn">
                        <span><?php echo $btn['text']; ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Social Icons Footer -->
        <footer class="social-footer">
            <a href="https://www.instagram.com/reel/DS6ak7BEpaW/?igsh=aDJ1ZjFxY2lkMno3" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="https://vt.tiktok.com/ZS5jF5rKC/" target="_blank" class="social-icon"><i class="fab fa-tiktok"></i></a>
            <a href="https://www.facebook.com/share/v/1E3SPCBeGB/" target="_blank" class="social-icon"><i class="fab fa-facebook"></i></a>
            <a href="https://www.facebook.com/share/1BoceHu3th/" target="_blank" class="social-icon"><i class="fab fa-facebook"></i></a>
        </footer>
    </main>
</body>
</html>
