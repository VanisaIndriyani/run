<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat & Maklumat - Run For Peace 2026</title>
    <link rel="stylesheet" href="style_poster.css?v=10012">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&family=Poppins:wght@400;600;700&family=Dancing+Script:wght@700&family=Bangers&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .docs-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 3rem 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .docs-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .docs-header h1 {
            color: #003366;
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .docs-header p {
            color: #555;
            font-size: 1.1rem;
        }

        .docs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .doc-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border: 1px solid #eee;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .doc-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #0069d9;
        }

        .doc-icon {
            font-size: 4rem;
            color: #003366;
            margin-bottom: 1.5rem;
        }

        .doc-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #333;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .doc-desc {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .download-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #0069d9;
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
            box-sizing: border-box;
        }

        .download-btn:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }

        .download-btn.secondary {
            background: #28a745;
        }

        .download-btn.secondary:hover {
            background: #218838;
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
            .docs-grid {
                grid-template-columns: 1fr;
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

        <div class="docs-container">
            <div class="docs-header">
                <h1>SURAT & MAKLUMAT BERKAITAN</h1>
                <p>Muat turun dokumen rasmi dan maklumat penting program</p>
            </div>

            <div class="docs-grid">
                <!-- Surat Kebenaran -->
                <div class="doc-card">
                    <div>
                        <i class="fas fa-file-signature doc-icon"></i>
                        <h3 class="doc-title">Surat Kebenaran Ibu Bapa</h3>
                        <p class="doc-desc">Borang kebenaran ibu bapa/penjaga untuk peserta di bawah umur 18 tahun.</p>
                    </div>
                    <a href="img/Surat%20Akuan%20Kebenaran%20Ibu%20Bapa.pdf" class="download-btn" download="Surat Akuan Kebenaran Ibu Bapa.pdf"><i class="fas fa-download"></i> MUAT TURUN PDF</a>
                </div>
            </div>

            <div class="back-button-container">
                <a href="index.php" class="btn-back"><i class="fas fa-arrow-left"></i> KEMBALI KE UTAMA</a>
            </div>
        </div>
    </main>
</body>
</html>