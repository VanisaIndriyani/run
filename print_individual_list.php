<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

require 'vendor/autoload.php';
include 'db_connect.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Fetch individual participants
$sql = "SELECT * FROM participants ORDER BY reg_date DESC";
$result = $conn->query($sql);

// Setup Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Logo processing
$logoPath = 'img/logo.jpg';
$logoData = base64_encode(file_get_contents($logoPath));
$logoSrc = 'data:image/jpeg;base64,' . $logoData;

$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Senarai Peserta Individu</title>
    <style>
        @page { margin: 30px; }
        body { font-family: "Helvetica", "Arial", sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #003366; padding-bottom: 10px; }
        .logo { width: 60px; height: auto; margin-bottom: 5px; }
        .title { font-size: 16px; font-weight: bold; color: #003366; text-transform: uppercase; margin: 5px 0; }
        .subtitle { font-size: 10px; color: #666; letter-spacing: 1px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; vertical-align: middle; }
        th { background-color: #003366; color: #fff; font-weight: bold; text-transform: uppercase; font-size: 10px; }
        tr:nth-child(even) { background-color: #f8f9fa; }
        
        .badge { background-color: #e3f2fd; color: #0d47a1; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 10px; border: 1px solid #bbdefb; }
        .footer { position: fixed; bottom: 0; left: 0; right: 0; font-size: 9px; color: #999; text-align: right; border-top: 1px solid #eee; padding-top: 5px; }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(0, 51, 102, 0.05);
            font-weight: bold;
            z-index: -1;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="watermark">RUN FOR PEACE</div>

    <div class="header">
        <img src="' . $logoSrc . '" class="logo">
        <div class="title">Senarai Peserta Individu</div>
        <div class="subtitle">RUN FOR PEACE 2026</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">BIL</th>
                <th style="width: 35%;">NAMA PENUH</th>
                <th style="width: 25%;">NO. KAD PENGENALAN</th>
                <th style="width: 20%;">NO. TEL</th>
                <th style="width: 15%; text-align: center;">JARAK</th>
            </tr>
        </thead>
        <tbody>';

if ($result->num_rows > 0) {
    $i = 1;
    while($row = $result->fetch_assoc()) {
        $html .= '
            <tr>
                <td style="text-align: center;">' . $i++ . '</td>
                <td>' . strtoupper($row['nama_penuh']) . '</td>
                <td>' . $row['ic_number'] . '</td>
                <td>' . $row['no_telefon'] . '</td>
                <td style="text-align: center;"><span class="badge">' . $row['distance'] . '</span></td>
            </tr>';
    }
} else {
    $html .= '<tr><td colspan="5" style="text-align: center;">Tiada rekod dijumpai.</td></tr>';
}

$html .= '
        </tbody>
    </table>
    
    <div class="footer">
        Dicetak pada: ' . date('d/m/Y h:i A') . ' | Run For Peace 2026 Admin Panel
    </div>
</body>
</html>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Senarai_Peserta_Individu.pdf", ["Attachment" => true]);
?>
