<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentatif Program - Run For Peace 2026</title>
    <link rel="stylesheet" href="style_poster.css?v=10011">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&family=Poppins:wght@400;600;700&family=Dancing+Script:wght@700&family=Bangers&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .tentative-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 3rem 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .tentative-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .tentative-header h1 {
            color: #003366;
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .tentative-header p {
            color: #555;
            font-size: 1.1rem;
        }

        /* Timeline Styles */
        .timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }

        .timeline::after {
            content: '';
            position: absolute;
            width: 4px;
            background-color: #0069d9;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
            border-radius: 2px;
        }

        .timeline-item {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
            box-sizing: border-box;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            right: -10px;
            background-color: white;
            border: 4px solid #ff9900;
            top: 20px;
            border-radius: 50%;
            z-index: 1;
        }

        .left {
            left: 0;
        }

        .right {
            left: 50%;
        }

        .left::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            right: 30px;
            border: medium solid white;
            border-width: 10px 0 10px 10px;
            border-color: transparent transparent transparent white;
        }

        .right::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            left: 30px;
            border: medium solid white;
            border-width: 10px 10px 10px 0;
            border-color: transparent white transparent transparent;
        }

        .right::after {
            left: -10px;
        }

        .timeline-content {
            padding: 20px 30px;
            background-color: white;
            position: relative;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-left: 5px solid #003366;
            transition: transform 0.3s;
        }

        .timeline-content:hover {
            transform: translateY(-5px);
        }

        .time-badge {
            background: #003366;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }

        .timeline-content h3 {
            margin: 0 0 10px 0;
            color: #333;
            font-family: 'Poppins', sans-serif;
        }

        .timeline-content p {
            margin: 0;
            color: #666;
            font-size: 0.95rem;
        }
        
        .timeline-content ul {
            padding-left: 20px;
            margin: 10px 0 0;
            color: #666;
        }

        .timeline-content ul li {
            margin-bottom: 5px;
        }

        /* Mobile Responsive */
        @media screen and (max-width: 600px) {
            .timeline::after {
                left: 31px;
            }
            
            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }
            
            .timeline-item::before {
                left: 60px;
                border: medium solid white;
                border-width: 10px 10px 10px 0;
                border-color: transparent white transparent transparent;
            }

            .left::after, .right::after {
                left: 21px;
            }
            
            .right {
                left: 0%;
            }
        }

        .back-button-container {
            text-align: center;
            margin-top: 3rem;
        }
        
        .btn-back {
            display: inline-block;
            background: #003366;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(0,51,102,0.3);
        }
        
        .btn-back:hover {
            background: #004a99;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,51,102,0.4);
        }
    </style>
</head>
<body class="poster-body">
    <main class="poster-container" style="max-width: 1200px;">
        <!-- Header Logos -->
        <header class="poster-header">
            <div class="logos-container">
                <img src="img/logo.jpg" alt="Logo Pengakap" class="header-logo">
                <img src="img/logo2.jpg" alt="Logo Run For Peace" class="header-logo">
            </div>
            <div class="header-text">
                <h3>PERSEKUTUAN PENGAKAP MALAYSIA</h3>
                <p>DAERAH TANGKAK</p>
            </div>
        </header>

        <div class="tentative-container">
            <div class="tentative-header">
                <h1>TENTATIF PROGRAM</h1>
                <p>28 SEPTEMBER 2026 (AHAD)</p>
            </div>

            <div class="timeline">
                <div class="timeline-item left">
                    <div class="timeline-content">
                        <span class="time-badge">6:00 PAGI</span>
                        <h3>Kehadiran Urusetia</h3>
                        <p>Kehadiran urusetia bertugas.</p>
                    </div>
                </div>
                <div class="timeline-item right">
                    <div class="timeline-content">
                        <span class="time-badge">6:30 PAGI</span>
                        <h3>Pendaftaran</h3>
                        <p>Kehadiran peserta & pendaftaran peserta bermula.</p>
                    </div>
                </div>
                <div class="timeline-item left">
                    <div class="timeline-content">
                        <span class="time-badge">7:00 PAGI</span>
                        <h3>Ketibaan Tetamu</h3>
                        <p>Ketibaan tetamu jemputan.</p>
                    </div>
                </div>
                <div class="timeline-item right">
                    <div class="timeline-content">
                        <span class="time-badge">7:15 PAGI</span>
                        <h3>Ketibaan VIP</h3>
                        <p>Ketibaan Perasmi (VIP).</p>
                    </div>
                </div>
                <div class="timeline-item left">
                    <div class="timeline-content">
                        <span class="time-badge">7:25 PAGI</span>
                        <h3>Senamrobik</h3>
                        <p>Senamrobik di padang sekolah.</p>
                    </div>
                </div>
                <div class="timeline-item right">
                    <div class="timeline-content">
                        <span class="time-badge">7:45 PAGI</span>
                        <h3>Majlis Perasmian & Pelepasan</h3>
                        <p>Ucapan Pegawai Daerah Tangkak.</p>
                        <ul>
                            <li>Pengacara majlis akan memulakan acara.</li>
                            <li>VIP bergerak ke pentas perlepasan (tepi jalan).</li>
                            <li>Bacaan Doa Selamat.</li>
                            <li>Flag Off Tangkak Run for Peace 2026.</li>
                        </ul>
                    </div>
                </div>
                <div class="timeline-item left">
                    <div class="timeline-content">
                        <span class="time-badge">10:30 PAGI</span>
                        <h3>Tamat Larian</h3>
                        <p>Jangkaan pelari terakhir sampai ke garisan penamat.</p>
                    </div>
                </div>
                <div class="timeline-item right">
                    <div class="timeline-content">
                        <span class="time-badge">11:00 PAGI</span>
                        <h3>Rehat & Pameran</h3>
                        <p>Rehat (Free & Easy).</p>
                        <p>Lawatan ke tapak pameran & jualan.</p>
                    </div>
                </div>
                <div class="timeline-item left">
                    <div class="timeline-content">
                        <span class="time-badge">12:00 TENGAH HARI</span>
                        <h3>Cabutan Bertuah</h3>
                        <p>Cabutan bertuah di depan Pentas sekolah sawah ring.</p>
                        <ul>
                            <li>Penyampaian hadiah Grand Prize oleh PPD/SC.</li>
                        </ul>
                    </div>
                </div>
                <div class="timeline-item right">
                    <div class="timeline-content">
                        <span class="time-badge">1:10 PETANG</span>
                        <h3>Bersurai</h3>
                        <p>Program tamat.</p>
                    </div>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 20px; color: #666; font-style: italic;">
                *TENTATIF TERTAKLUK KEPADA PERUBAHAN
            </div>

            <div class="back-button-container">
                <a href="index.php" class="btn-back"><i class="fas fa-arrow-left"></i> KEMBALI KE UTAMA</a>
            </div>
        </div>
    </main>
</body>
</html>