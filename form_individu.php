<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borang Pendaftaran Individu - Run For Peace 2026</title>
    <link rel="stylesheet" href="style_form.css?v=10006">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="form-body">
    <div class="form-container">
        <div class="form-header">
            <img src="img/logo.jpg" alt="Logo Run For Peace" class="form-logo">
            <h2>BORANG PENDAFTARAN INDIVIDU</h2>
            <p>Sila isi maklumat peribadi anda dengan lengkap.</p>
        </div>

        <form action="process_registration.php" method="POST" enctype="multipart/form-data">
            <!-- Maklumat Peribadi -->
            <div class="form-section">
                <h3><i class="fas fa-user-circle"></i> Maklumat Peribadi</h3>
                
                <div class="form-group">
                    <label>Nama Penuh (Huruf Besar)</label>
                    <input type="text" name="nama_penuh" required style="text-transform: uppercase;" placeholder="NAMA SEPERTI DALAM KAD PENGENALAN">
                </div>

                <div class="form-group">
                    <label>Kad Pengenalan</label>
                    <input type="text" name="ic_number" required placeholder="000000-01-0000">
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>Jantina</label>
                        <select name="jantina" required>
                            <option value="">- Pilih -</option>
                            <option value="Lelaki">Lelaki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group half">
                        <label>Umur</label>
                        <input type="number" name="umur" required placeholder="Umur semasa">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>Kaum</label>
                        <select name="kaum" required>
                            <option value="">- Pilih -</option>
                            <option value="Melayu">Melayu</option>
                            <option value="Cina">Cina</option>
                            <option value="India">India</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                    </div>
                    <div class="form-group half">
                        <label>Agama</label>
                        <select name="agama_select" required id="agamaSelect" onchange="toggleAgama(this)">
                            <option value="">- Pilih -</option>
                            <option value="ISLAM">ISLAM</option>
                            <option value="BUDDHA">BUDDHA</option>
                            <option value="HINDU">HINDU</option>
                            <option value="KRISTIAN">KRISTIAN</option>
                            <option value="Lain-lain">Yang lain:</option>
                        </select>
                        <input type="text" name="agama_lain" id="agamaLainInput" placeholder="Sila nyatakan" style="display:none; margin-top:10px;">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>No Telefon</label>
                    <input type="tel" name="no_telefon" required placeholder="Contoh: 012-3456789">
                </div>
            </div>

            <script>
            function toggleAgama(select) {
                var input = document.getElementById('agamaLainInput');
                if (select.value === 'Lain-lain') {
                    input.style.display = 'block';
                    input.required = true;
                } else {
                    input.style.display = 'none';
                    input.required = false;
                    input.value = '';
                }
            }
            
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

            <!-- Maklumat Pendidikan -->
            <div class="form-section">
                <h3><i class="fas fa-graduation-cap"></i> Maklumat Pendidikan</h3>
                <div class="form-group">
                    <label>Nama Sekolah</label>
                    <small class="form-hint">Untuk umur 5–17 tahun sahaja. Jika dewasa / tidak bersekolah tulis <strong>(-)</strong></small>
                    <input type="text" name="nama_sekolah" required placeholder="Nama Sekolah atau (-)">
                </div>
                <div class="form-group">
                    <label>Kod Sekolah</label>
                    <small class="form-hint">Contoh: JBA1234 (Jika ada)</small>
                    <input type="text" name="kod_sekolah" placeholder="Kod Sekolah">
                </div>
            </div>

            <!-- Kategori & Baju -->
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

            <!-- Size Selection -->
            <div class="form-section">
                <h3><i class="fas fa-tshirt"></i> Saiz Baju</h3>
                
                <div class="size-chart" style="text-align: center; margin-bottom: 1.5rem;">
                    <img src="img/ukuran unisex.png" alt="Carta Saiz Unisex" style="max-width: 100%; height: auto; border-radius: 8px; border: 1px solid #ddd; margin-bottom: 1rem;">
                    <img src="img/ukuran kids.png" alt="Carta Saiz Kids" style="max-width: 100%; height: auto; border-radius: 8px; border: 1px solid #ddd;">
                </div>

                <div class="form-group">
                    <label>Sila Pilih Saiz</label>
                    <select name="tshirt_size" required>
                        <option value="">- Pilih Saiz -</option>
                        <optgroup label="Kanak-kanak">
                            <option value="24">24</option>
                            <option value="26">26</option>
                            <option value="28">28</option>
                            <option value="30">30</option>
                            <option value="32">32</option>
                            <option value="34">34</option>
                        </optgroup>
                        <optgroup label="Dewasa (Unisex)">
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
                        </optgroup>
                    </select>
                </div>
            </div>

            <!-- Maklumat Kecemasan -->
            <div class="form-section">
                <h3><i class="fas fa-ambulance"></i> Maklumat Kecemasan</h3>
                <div class="form-group">
                    <label>Nama (Untuk Dihubungi Jika Kecemasan)</label>
                    <input type="text" name="ec_name" required placeholder="Nama Waris / Penjaga / Pasangan">
                </div>
                <div class="form-group">
                    <label>Nombor Telefon Kecemasan</label>
                    <input type="tel" name="ec_number" required placeholder="Nombor telefon kecemasan">
                </div>
            </div>



            <!-- Pembayaran -->
            <div class="form-section">
                <h3><i class="fas fa-credit-card"></i> Pembayaran Online</h3>
                
                <div class="payment-card">
                    <div class="pay-now-container">
                        <a href="https://toyyibpay.com/BAYARAN-TANGKAK-RUN-FOR-PEACE-2026" target="_blank" class="pay-now-btn">
                            <i class="fas fa-external-link-alt"></i> BAYAR SEKARANG
                        </a>
                        <p class="payment-instruction">Klik butang di atas untuk membuka laman pembayaran selamat</p>
                    </div>

                    <hr class="payment-divider">

                    <div>
                        <input type="hidden" name="payment_method" value="ToyyibPay">
                        
                        <div class="form-group upload-section">
                            <label class="upload-label">Upload Bukti Pembayaran <span style="color:red">*</span></label>
                            <input type="file" name="payment_receipt" required accept="image/*,application/pdf" class="upload-input">
                            <small class="upload-hint">Sila muat naik resit pembayaran anda (Gambar/PDF).</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">DAFTAR SEKARANG</button>
                <a href="pendaftaran_individu.php" class="cancel-btn">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>