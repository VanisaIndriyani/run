<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trek Larian - Run For Peace 2026</title>
    <link rel="stylesheet" href="style_poster.css?v=10010">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&family=Poppins:wght@400;600;700&family=Dancing+Script:wght@700&family=Bangers&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .track-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .track-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .track-header h1 {
            color: #003366;
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        
        .track-section {
            margin-bottom: 4rem;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }
        
        .track-title-bar {
            background: #003366;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .track-title-bar h2 {
            margin: 0;
            font-family: 'Bangers', cursive;
            letter-spacing: 1px;
            font-size: 1.8rem;
        }
        
        .track-content {
            padding: 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            align-items: center;
        }
        
        .track-info {
            flex: 1;
            min-width: 300px;
        }
        
        .track-map-placeholder {
            flex: 1;
            min-width: 300px;
            background: #f8f9fa;
            border: 2px dashed #ddd;
            border-radius: 10px;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: #888;
        }

        .track-details-list {
            list-style: none;
            padding: 0;
        }
        
        .track-details-list li {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
            color: #444;
        }
        
        .track-details-list i {
            color: #0069d9;
            width: 25px;
            text-align: center;
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

        @media (max-width: 768px) {
            .track-content {
                flex-direction: column;
            }
            .track-header h1 {
                font-size: 2rem;
            }
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

        <div class="track-container">
            <div class="track-header">
                <h1>INFO LALUAN LARIAN</h1>
                <p>Maklumat terperinci mengenai laluan 5KM dan 10KM</p>
            </div>

            <!-- 5KM Section -->
            <div class="track-section">
                <div class="track-title-bar">
                    <h2>5 KM - FUN RUN</h2>
                    <i class="fas fa-running fa-2x"></i>
                </div>
                <div class="track-content">
                    <div class="track-info">
                        <h3>Maklumat Laluan</h3>
                        <ul class="track-details-list">
                            <li><i class="fas fa-flag-checkered"></i> <strong>Pelepasan:</strong> 7:15 PAGI</li>
                            <li><i class="fas fa-ruler"></i> <strong>Jarak:</strong> 5 Kilometer</li>
                            <li><i class="fas fa-stopwatch"></i> <strong>Masa Kelayakan:</strong> 2 Jam</li>
                            <li><i class="fas fa-tint"></i> <strong>Water Station:</strong> KM 2.5</li>
                            <li><i class="fas fa-medkit"></i> <strong>Checkpoints:</strong> 1 (KM 2.5)</li>
                        </ul>
                    </div>
                    <div class="track-map-placeholder" style="padding: 0; border: none; overflow: hidden;">
                        <iframe src="https://www.google.com/maps/d/embed?mid=1rO-BMo5Elf_Q9DxJ6a8QDwyYBsKxpuc&ehbc=2E312F" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <!-- 10KM Section -->
            <div class="track-section">
                <div class="track-title-bar" style="background: #a00;">
                    <h2>10 KM - POWER RUN</h2>
                    <i class="fas fa-fire fa-2x"></i>
                </div>
                <div class="track-content">
                    <div class="track-info">
                        <h3>Maklumat Laluan</h3>
                        <ul class="track-details-list">
                            <li><i class="fas fa-flag-checkered"></i> <strong>Pelepasan:</strong> 7:00 PAGI</li>
                            <li><i class="fas fa-ruler"></i> <strong>Jarak:</strong> 10 Kilometer</li>
                            <li><i class="fas fa-stopwatch"></i> <strong>Masa Kelayakan:</strong> 3 Jam</li>
                            <li><i class="fas fa-tint"></i> <strong>Water Station:</strong> KM 3, KM 7</li>
                            <li><i class="fas fa-medkit"></i> <strong>Checkpoints:</strong> 2 (KM 3, KM 7)</li>
                        </ul>
                    </div>
                    <div class="track-map-placeholder" style="padding: 0; border: none; overflow: hidden;">
                        <iframe src="https://www.google.com/maps/d/embed?mid=1-XKZBzwQiUpXNXAqsDfmsq1mq7SqFoQ&ehbc=2E312F" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <div class="back-button-container">
                <a href="index.php" class="btn-back"><i class="fas fa-arrow-left"></i> KEMBALI KE UTAMA</a>
            </div>
        </div>
    </main>
</body>
</html>