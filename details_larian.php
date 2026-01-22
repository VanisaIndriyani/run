<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilihan Larian - Run For Peace 2026</title>
    <link rel="stylesheet" href="style_form.css?v=10002">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="form-body">
    <div class="form-container">
        <div class="form-header">
            <div class="logos-container" style="margin-bottom: 1rem;">
                <img src="img/logo.jpg" alt="Logo Pengakap" class="form-logo" style="width: 80px; height: 80px; border:none; box-shadow:none;">
                <img src="img/logo2.jpg" alt="Logo Run For Peace" class="form-logo" style="width: 80px; height: 80px; border:none; box-shadow:none;">
            </div>
            <h2 style="color: #003366; font-size: 1.5rem;">TERIMA KASIH SERTAI LARIAN TANGKAK RUN FOR PEACE 2026</h2>
            <p style="color: #0056b3; font-weight: bold;">HANYA INDIVIDU SAHAJA *</p>
            <p>(Sila Pilih dibawah)</p>
        </div>

        <?php
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id == 0) {
            echo "<p style='text-align:center; color:red;'>Ralat: ID Peserta tidak dijumpai.</p>";
            exit;
        }
        ?>

        <form action="process_details.php" method="POST">
            <input type="hidden" name="participant_id" value="<?php echo $id; ?>">

            <!-- Distance Selection -->
            <div class="form-section">
                <h3><i class="fas fa-running"></i> Jarak Larian</h3>
                <div class="selection-grid">
                    <label class="selection-card">
                        <input type="radio" name="jarak_larian" value="5KM" required onchange="updateTshirt('5KM')" checked>
                        <div class="card-content">
                            <i class="fas fa-bolt distance-icon" style="color: #ff9900;"></i>
                            <span class="distance-label">5 KM</span>
                            <span class="distance-sub">Fun Run</span>
                        </div>
                    </label>
                    <label class="selection-card">
                        <input type="radio" name="jarak_larian" value="10KM" required onchange="updateTshirt('10KM')">
                        <div class="card-content">
                            <i class="fas fa-fire distance-icon" style="color: #ff3300;"></i>
                            <span class="distance-label">10 KM</span>
                            <span class="distance-sub">Power Run</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- T-shirt Display -->
            <div class="form-section" style="text-align: center;">
                <p style="margin-bottom: 0.5rem; font-weight: 600; color: #666;">Design Baju (Berubah mengikut jarak)</p>
                <img src="img/5KM.png" id="tshirtPreview" alt="T-shirt Preview" style="max-width: 100%; height: auto; border-radius: 10px; margin-bottom: 1rem; transition: opacity 0.3s;">
            </div>

            <script>
            function updateTshirt(distance) {
                var img = document.getElementById('tshirtPreview');
                img.style.opacity = 0;
                
                setTimeout(function() {
                    if (distance === '5KM') {
                        img.src = 'img/5KM.png';
                    } else if (distance === '10KM') {
                        img.src = 'img/10 km.png';
                    }
                    img.onload = function() {
                        img.style.opacity = 1;
                    };
                }, 300);
            }
            </script>

            <!-- Size Selection -->
            <div class="form-section">
                <h3><i class="fas fa-tshirt"></i> Saiz Baju (Unisex)</h3>
                
                <div class="size-chart" style="text-align: center; margin-bottom: 1.5rem;">
                    <img src="img/ukuran unisex.png" alt="Carta Saiz Unisex" style="max-width: 100%; height: auto; border-radius: 8px; border: 1px solid #ddd; margin-bottom: 1rem;">
                    <img src="img/ukuran kids.png" alt="Carta Saiz Kids" style="max-width: 100%; height: auto; border-radius: 8px; border: 1px solid #ddd;">
                </div>

                <div class="form-group">
                    <label>Sila Pilih Saiz</label>
                    <select name="saiz_baju" required>
                        <option value="">- Pilih -</option>
                        <option value="2XS">2XS</option>
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="2XL">2XL</option>
                        <option value="3XL">3XL</option>
                        <option value="4XL">4XL</option>
                        <option value="5XL">5XL</option>
                        <option value="6XL">6XL</option>
                        <option value="7XL">7XL</option>
                        <option value="8XL">8XL</option>
                    </select>
                </div>
            </div>

            <!-- Telegram Group -->
            <div class="form-section">
                <h3><i class="fab fa-telegram"></i> Group Telegram</h3>
                <p style="font-weight: 600; color: #333;">SETELAH TEKAN LINK DIBAWAH, SILA PASTIKAN ANDA KEMBALI KE BORANG INI UNTUK TEKAN SUBMIT, SEMUA INFO AKAN DIMAKLUMKAN DALAM GROUP TELEGRAM TANGKAK RUN FOR PEACE 2026</p>
                <a href="https://t.me/+fiFZ_fVaLd1kNGRl" target="_blank" style="color: #0088cc; font-weight: bold; text-decoration: underline; word-break: break-all;">https://t.me/+fiFZ_fVaLd1kNGRl</a>
                <div class="form-group" style="margin-top: 1rem;">
                    <label class="radio-label">
                        <input type="checkbox" name="telegram_joined" value="1" required> Done masuk
                    </label>
                </div>
            </div>

            <!-- Payment -->
            <div class="form-section">
                <h3><i class="fas fa-university"></i> Pilih Bank (Online Banking)</h3>
                <div class="form-group">
                    <p style="margin-bottom: 1rem; color: #666;">Sila pilih bank anda untuk meneruskan pembayaran:</p>
                    <div class="bank-list-container">
                        <label class="bank-option">
                            <span class="bank-name">Affin Bank</span>
                            <input type="radio" name="payment_method" value="Affin Bank" required>
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">AGRONet</span>
                            <input type="radio" name="payment_method" value="AGRONet">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">Alliance Bank (Personal)</span>
                            <input type="radio" name="payment_method" value="Alliance Bank (Personal)">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">AmBank</span>
                            <input type="radio" name="payment_method" value="AmBank">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">Bank Islam</span>
                            <input type="radio" name="payment_method" value="Bank Islam">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">Bank Muamalat</span>
                            <input type="radio" name="payment_method" value="Bank Muamalat">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">Bank Of China</span>
                            <input type="radio" name="payment_method" value="Bank Of China">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">Bank Rakyat</span>
                            <input type="radio" name="payment_method" value="Bank Rakyat">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">BSN</span>
                            <input type="radio" name="payment_method" value="BSN">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">CIMB Clicks</span>
                            <input type="radio" name="payment_method" value="CIMB Clicks">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">Hong Leong Bank</span>
                            <input type="radio" name="payment_method" value="Hong Leong Bank">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">HSBC Bank</span>
                            <input type="radio" name="payment_method" value="HSBC Bank">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">KFH</span>
                            <input type="radio" name="payment_method" value="KFH">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">Maybank2E</span>
                            <input type="radio" name="payment_method" value="Maybank2E">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">Maybank2U</span>
                            <input type="radio" name="payment_method" value="Maybank2U">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">OCBC Bank</span>
                            <input type="radio" name="payment_method" value="OCBC Bank">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">Public Bank</span>
                            <input type="radio" name="payment_method" value="Public Bank">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">RHB Bank</span>
                            <input type="radio" name="payment_method" value="RHB Bank">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">Standard Chartered</span>
                            <input type="radio" name="payment_method" value="Standard Chartered">
                            <span class="radio-checkmark"></span>
                        </label>
                        <label class="bank-option">
                            <span class="bank-name">UOB Bank</span>
                            <input type="radio" name="payment_method" value="UOB Bank">
                            <span class="radio-checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">HANTAR PENDAFTARAN</button>
            </div>
        </form>
    </div>
</body>
</html>