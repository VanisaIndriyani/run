<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Run For Peace 2026</title>
    <link rel="stylesheet" href="style_poster.css?v=10013">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&family=Poppins:wght@400;600;700&family=Dancing+Script:wght@700&family=Bangers&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .contact-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 3rem 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .contact-header {
            margin-bottom: 3rem;
        }
        
        .contact-header h1 {
            color: #003366;
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .contact-header p {
            color: #555;
            font-size: 1.1rem;
        }

        .contact-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .contact-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
            border: 1px solid #eee;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #0069d9;
        }

        .contact-icon {
            font-size: 3rem;
            color: #0069d9;
            margin-bottom: 1.5rem;
        }

        .contact-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #333;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .contact-btn {
            display: inline-block;
            padding: 10px 25px;
            background: #25D366;
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .contact-btn:hover {
            background: #128C7E;
            transform: scale(1.05);
        }

        .contact-btn.email {
            background: #EA4335;
        }

        .contact-btn.email:hover {
            background: #B93321;
        }

        .back-button-container {
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

        <div class="contact-container">
            <div class="contact-header">
                <h1>SEBARANG PERTANYAAN</h1>
                <p>Hubungi jawatankuasa penganjur untuk maklumat lanjut</p>
            </div>

            <div class="contact-cards" style="display: flex; justify-content: center;">
                <!-- WhatsApp Contact -->
                <div class="contact-card">
                    <i class="fab fa-whatsapp contact-icon"></i>
                    <h3 class="contact-title">Tuan Ibrahim bin yakob</h3>
                    <p>Sebarang Pertanyaan Sila Hubungi</p>
                    <a href="https://wa.me/60135979266" class="contact-btn" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>

            <div class="back-button-container">
                <a href="index.php" class="btn-back"><i class="fas fa-arrow-left"></i> KEMBALI KE UTAMA</a>
            </div>
        </div>
    </main>
</body>
</html>