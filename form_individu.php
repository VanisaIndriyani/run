<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borang Pendaftaran Individu - Run For Peace 2026</title>
    <link rel="stylesheet" href="style_form.css?v=10007">
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
                    <label>Nama Penuh (Huruf Besar) <span style="color:red">*</span></label>
                    <input type="text" name="nama_penuh" required style="text-transform: uppercase;" placeholder="NAMA SEPERTI DALAM KAD PENGENALAN">
                </div>

                <div class="form-group">
                    <label>Kad Pengenalan <span style="color:red">*</span></label>
                    <input type="text" name="ic_number" required placeholder="000000-01-0000">
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>Jantina <span style="color:red">*</span></label>
                        <select name="jantina" required>
                            <option value="">- Pilih -</option>
                            <option value="Lelaki">Lelaki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group half">
                        <label>Umur <span style="color:red">*</span></label>
                        <input type="number" name="umur" required placeholder="Umur semasa">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>Kaum <span style="color:red">*</span></label>
                        <select name="kaum" required>
                            <option value="">- Pilih -</option>
                            <option value="Melayu">Melayu</option>
                            <option value="Cina">Cina</option>
                            <option value="India">India</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                    </div>
                    <div class="form-group half">
                        <label>Agama <span style="color:red">*</span></label>
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
                    <label>No Telefon <span style="color:red">*</span></label>
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

            function previewFile() {
                const previewContainer = document.getElementById('file-preview-container');
                const previewImage = document.getElementById('file-preview-image');
                const previewText = document.getElementById('file-preview-text');
                const fileInput = document.getElementById('payment_receipt');
                const file = fileInput.files[0];

                if (file) {
                    previewContainer.style.display = 'block';
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                            previewImage.style.display = 'inline-block';
                            previewText.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        previewImage.style.display = 'none';
                        previewText.textContent = 'Fail terpilih: ' + file.name;
                        previewText.style.display = 'block';
                    }
                } else {
                    previewContainer.style.display = 'none';
                }
            }
            </script>

            <!-- Maklumat Pendidikan -->
            <div class="form-section">
                <h3><i class="fas fa-graduation-cap"></i> Maklumat Pendidikan</h3>
                <div class="form-group">
                    <label>Nama Sekolah <span style="color:red">*</span></label>
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
                <h3><i class="fas fa-running"></i> Jarak Larian <span style="color:red">*</span></h3>
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
                <h3><i class="fas fa-tshirt"></i> Saiz Baju <span style="color:red">*</span></h3>
                
                <div class="size-chart" style="text-align: center; margin-bottom: 1.5rem;">
                    <img src="img/ukuran unisex.png" alt="Carta Saiz Unisex" style="max-width: 100%; height: auto; border-radius: 8px; border: 1px solid #ddd; margin-bottom: 1rem;">
                    <img src="img/ukuran kids.png" alt="Carta Saiz Kids" style="max-width: 100%; height: auto; border-radius: 8px; border: 1px solid #ddd;">
                </div>

                <div class="form-group">
                    <label>Sila Pilih Saiz <span style="color:red">*</span></label>
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

            <!-- Emergency Contact -->
            <div class="form-section">
                <h3><i class="fas fa-first-aid"></i> Maklumat Kecemasan</h3>
                <div class="form-group">
                    <label>Nama Waris <span style="color:red">*</span></label>
                    <input type="text" name="ec_name" required placeholder="Nama untuk dihubungi">
                </div>
                <div class="form-group">
                    <label>No Telefon Waris <span style="color:red">*</span></label>
                    <input type="tel" name="ec_number" required placeholder="Contoh: 012-3456789">
                </div>
            </div>

            <!-- Payment Section -->
            <div class="form-section">
                <h3><i class="fas fa-wallet"></i> Pembayaran Online</h3>
                
                <div class="payment-card">
               
                    
                 

                    <a href="https://maybank2u.com.my" target="_blank" class="pay-now-btn">
                        <i class="fas fa-external-link-alt"></i> BAYAR SEKARANG
                    </a>
                </div>

                <div class="upload-section">
                    <label class="upload-label">Muat Naik Resit Pembayaran <span style="color:red">*</span></label>
                    <div class="file-upload-wrapper">
                        <input type="file" name="payment_receipt" id="payment_receipt" accept="image/*,application/pdf" required onchange="previewFile()">
                        <div class="upload-placeholder">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Klik untuk pilih fail atau seret ke sini</span>
                            <small>(Format: JPG, PNG, PDF)</small>
                        </div>
                    </div>
                    <div id="file-preview-container" style="margin-top: 15px; display: none;">
                        <img id="file-preview-image" src="" alt="Pratonton Resit" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; border-radius: 5px; display: none;">
                        <p id="file-preview-text" style="display: none; color: #333; font-weight: bold;"></p>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">DAFTAR SEKARANG</button>
                <a href="index.php" class="cancel-btn">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>