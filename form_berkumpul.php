<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berkumpul - Run For Peace 2026</title>
    <link rel="stylesheet" href="style_form.css?v=10005">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="form-body">
    <div class="form-container" style="max-width: 1400px;">
        <div class="form-header">
            <img src="img/logo.jpg" alt="Logo Run For Peace" class="form-logo">
            <h2>BORANG PENDAFTARAN BERKUMPUL</h2>
            <p>Sila isi maklumat peserta dalam jadual di bawah.</p>
        </div>

        <!-- Size Chart Modal -->
        <div id="sizeChartModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="toggleSizeChart()">&times;</span>
                <h3>Carta Saiz Baju</h3>
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div>
                        <h4>Dewasa (Unisex)</h4>
                        <img src="img/ukuran unisex.png" alt="Carta Saiz Dewasa" style="width:100%; height:auto;">
                    </div>
                    <div>
                        <h4>Kanak-Kanak</h4>
                        <img src="img/ukuran kids.png" alt="Carta Saiz Kanak-Kanak" style="width:100%; height:auto;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Design Modal -->
        <div id="designModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="toggleDesignModal()">&times;</span>
                <h3>Design Baju</h3>
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="text-align:center;">
                        <h4 style="color:#ff9900;">Design 5KM (Fun Run)</h4>
                        <img src="img/5KM.png" alt="Design 5KM" style="width:100%; max-width:400px; height:auto; border-radius:10px;">
                    </div>
                    <div style="text-align:center;">
                        <h4 style="color:#ff3300;">Design 10KM (Power Run)</h4>
                        <img src="img/10 km.png" alt="Design 10KM" style="width:100%; max-width:400px; height:auto; border-radius:10px;">
                    </div>
                </div>
            </div>
        </div>

        <form action="process_group_registration.php" method="POST" enctype="multipart/form-data" id="groupForm">
            
            <!-- Jumlah Peserta -->
            <div class="form-section">
                <h3><i class="fas fa-users"></i> Maklumat Kumpulan</h3>
                <div class="form-group">
                    <label>Jumlah Peserta (Orang)</label>
                    <input type="number" name="total_pax" id="totalParticipants" min="1" max="150" placeholder="Contoh: 10" oninput="generateRows()" required>
                    <small class="form-hint">Masukkan jumlah peserta untuk menjana jadual.</small>
                </div>
            </div>

            <!-- Senarai Peserta (Card Layout) -->
            <div class="form-section">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; flex-wrap:wrap; gap:10px;">
                    <h3><i class="fas fa-list"></i> Senarai Peserta</h3>
                    <div style="display:flex; gap:10px;">
                        <button type="button" class="view-chart-btn" onclick="toggleDesignModal()" style="background:#ff5722;"><i class="fas fa-tshirt"></i> Lihat Design Baju</button>
                        <button type="button" class="view-chart-btn" onclick="toggleSizeChart()"><i class="fas fa-ruler"></i> Lihat Ukuran Saiz</button>
                    </div>
                </div>
                
                <div id="participants-container">
                    <div class="empty-state">
                        <i class="fas fa-users" style="font-size: 3rem; color: #ddd; margin-bottom: 1rem;"></i>
                        <p>Sila masukkan jumlah peserta di bahagian atas untuk memaparkan borang.</p>
                    </div>
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

            <!-- Pembayaran -->
            <div class="form-section">
                <h3><i class="fas fa-credit-card"></i> Pembayaran Online</h3>
                <div class="form-row">
                    <div class="form-group half">
                        <label>Medium Bayaran</label>
                        <select name="payment_method" required>
                            <option value="">- Pilih Bank / E-Wallet -</option>
                            <option value="Maybank">Maybank</option>
                            <option value="CIMB">CIMB Bank</option>
                            <option value="Public Bank">Public Bank</option>
                            <option value="RHB">RHB Bank</option>
                            <option value="Hong Leong">Hong Leong Bank</option>
                            <option value="AmBank">AmBank</option>
                            <option value="Bank Islam">Bank Islam</option>
                            <option value="TNG">Touch 'n Go eWallet</option>
                            <option value="DuitNow">DuitNow QR</option>
                        </select>
                    </div>
                    <div class="form-group half">
                        <label>Bukti Pembayaran (Resit)</label>
                        <input type="file" name="payment_receipt" required accept="image/*,.pdf">
                        <small class="form-hint">Format: JPG, PNG, PDF. Maks: 5MB</small>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">DAFTAR KUMPULAN</button>
                <a href="index.php" class="cancel-btn">Kembali</a>
            </div>
        </form>
    </div>

    <script>
        console.log("Script loaded successfully");

        // Define functions globally
        window.toggleSizeChart = function() {
            const modal = document.getElementById('sizeChartModal');
            if (modal.style.display === 'flex') {
                modal.style.display = 'none';
            } else {
                modal.style.display = 'flex';
            }
        }

        window.toggleDesignModal = function() {
            const modal = document.getElementById('designModal');
            if (!modal) {
                console.error("Design modal not found!");
                return;
            }
            if (modal.style.display === 'flex') {
                modal.style.display = 'none';
            } else {
                modal.style.display = 'flex';
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const sizeModal = document.getElementById('sizeChartModal');
            const designModal = document.getElementById('designModal');
            if (event.target == sizeModal) {
                sizeModal.style.display = 'none';
            }
            if (event.target == designModal) {
                designModal.style.display = 'none';
            }
        }

        window.updateGroupTshirt = function(distance, index) {
            var img = document.getElementById('tshirtPreview-' + index);
            if (!img) return;
            
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

        function generateRows() {
            const count = document.getElementById('totalParticipants').value;
            const container = document.getElementById('participants-container');
            container.innerHTML = '';

            if (count < 1) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-users" style="font-size: 3rem; color: #ddd; margin-bottom: 1rem;"></i>
                        <p>Sila masukkan jumlah peserta di bahagian atas untuk memaparkan borang.</p>
                    </div>`;
                return;
            }

            for (let i = 1; i <= count; i++) {
                const card = document.createElement('div');
                card.className = 'participant-card';
                card.innerHTML = `
                    <div class="card-header">
                        <h4><i class="fas fa-user"></i> Peserta ${i}</h4>
                    </div>
                    <div class="card-body">
                        <!-- Maklumat Peribadi -->
                        <div class="card-section">
                            <h5><i class="fas fa-user-circle"></i> Maklumat Peribadi</h5>
                            <div class="card-grid">
                                <div class="card-field full-width">
                                    <label>Nama Penuh (Huruf Besar)</label>
                                    <input type="text" name="participants[${i}][name]" class="table-input" required placeholder="Nama Penuh (seperti IC)" style="text-transform: uppercase;">
                                </div>
                                
                                <div class="card-field">
                                    <label>No. IC / MyKid</label>
                                    <input type="text" name="participants[${i}][ic]" class="table-input" required placeholder="000000-00-0000">
                                </div>
                                
                                <div class="card-field">
                                    <label>Umur</label>
                                    <input type="number" name="participants[${i}][age]" class="table-input" required placeholder="Umur">
                                </div>

                                <div class="card-field">
                                    <label>No. Tel</label>
                                    <input type="tel" name="participants[${i}][phone]" class="table-input" required placeholder="No. Tel">
                                </div>

                                <div class="card-field">
                                    <label>Jantina</label>
                                    <select name="participants[${i}][gender]" class="table-select" required>
                                        <option value="Lelaki">Lelaki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>

                                <div class="card-field">
                                    <label>Kaum</label>
                                    <select name="participants[${i}][race]" class="table-select" required>
                                        <option value="Melayu">Melayu</option>
                                        <option value="Cina">Cina</option>
                                        <option value="India">India</option>
                                        <option value="Lain-lain">Lain-lain</option>
                                    </select>
                                </div>

                                <div class="card-field">
                                    <label>Agama</label>
                                    <select name="participants[${i}][religion]" class="table-select" required>
                                        <option value="Islam">Islam</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Kristian">Kristian</option>
                                        <option value="Lain-lain">Lain-lain</option>
                                    </select>
                                </div>

                                <div class="card-field full-width">
                                    <label>Nama Sekolah (Jika Pelajar)</label>
                                    <input type="text" name="participants[${i}][school]" class="table-input" placeholder="Nama Sekolah atau (-) jika tidak berkenaan">
                                </div>
                            </div>
                        </div>

                        <!-- Kategori & Baju -->
                        <div class="card-section">
                            <h5><i class="fas fa-tshirt"></i> Kategori & Baju</h5>
                            <div class="card-grid">
                                <div class="card-field full-width">
                                    <label>Jarak Larian</label>
                                    <div class="selection-grid" style="grid-template-columns: repeat(2, 1fr); gap: 10px;">
                                        <label class="selection-card" style="margin-bottom: 0;">
                                            <input type="radio" name="participants[${i}][distance]" value="5KM" required onchange="window.updateGroupTshirt('5KM', ${i})" checked>
                                            <div class="card-content" style="padding: 1rem;">
                                                <i class="fas fa-bolt distance-icon" style="color: #ff9900; font-size: 1.5rem;"></i>
                                                <span class="distance-label" style="font-size: 1.2rem;">5 KM</span>
                                                <span class="distance-sub" style="font-size: 0.7rem;">Fun Run</span>
                                            </div>
                                        </label>
                                        <label class="selection-card" style="margin-bottom: 0;">
                                            <input type="radio" name="participants[${i}][distance]" value="10KM" required onchange="window.updateGroupTshirt('10KM', ${i})">
                                            <div class="card-content" style="padding: 1rem;">
                                                <i class="fas fa-fire distance-icon" style="color: #ff3300; font-size: 1.5rem;"></i>
                                                <span class="distance-label" style="font-size: 1.2rem;">10 KM</span>
                                                <span class="distance-sub" style="font-size: 0.7rem;">Power Run</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="card-field">
                                    <label>Preview Baju</label>
                                    <div style="text-align: center; border: 1px solid #ddd; border-radius: 8px; padding: 10px; background: #fff;">
                                        <img id="tshirtPreview-${i}" src="img/5KM.png" alt="Preview Baju" style="max-height: 150px; transition: opacity 0.3s ease;">
                                    </div>
                                </div>

                                <div class="card-field">
                                    <label>Saiz Baju</label>
                                    <select name="participants[${i}][tshirt_size]" class="table-select" required>
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
                        </div>

                        <!-- Maklumat Kecemasan -->
                        <div class="card-section">
                            <h5><i class="fas fa-ambulance"></i> Maklumat Kecemasan</h5>
                            <div class="card-grid">
                                <div class="card-field">
                                    <label>Nama Waris</label>
                                    <input type="text" name="participants[${i}][ec_name]" class="table-input" required placeholder="Nama Waris">
                                </div>

                                <div class="card-field">
                                    <label>Tel. Kecemasan</label>
                                    <input type="tel" name="participants[${i}][ec_phone]" class="table-input" required placeholder="Tel. Kecemasan">
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            }
        }

    </script>
</body>
</html>
