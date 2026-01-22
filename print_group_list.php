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

// Fetch group participants
$sql = "SELECT gp1.*, 
       (SELECT COUNT(*) FROM group_participants gp2 WHERE gp2.payment_proof = gp1.payment_proof AND gp1.payment_proof != '') as group_count 
       FROM group_participants gp1 
       ORDER BY reg_date DESC";
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
    <title>Senarai Peserta Berkelompok</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .logo { width: 80px; height: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .title { font-size: 18px; font-weight: bold; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <img src="' . $logoSrc . '" class="logo">
        <div class="title">SENARAI PESERTA BERKUMPULAN</div>
        <div>Run For Peace 2025</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">BIL</th>
                <th>NAMA PENUH</th>
                <th>NO. KAD PENGENALAN</th>
                <th>NO. TEL</th>
                <th>JARAK</th>
                <th>GROUP</th>
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
                <td style="text-align: center;">' . $row['distance'] . '</td>
                <td style="text-align: center;">' . $row['group_count'] . ' Pax</td>
            </tr>';
    }
} else {
    $html .= '<tr><td colspan="6" style="text-align: center;">Tiada rekod dijumpai.</td></tr>';
}

$html .= '
        </tbody>
    </table>
    <div style="margin-top: 20px; font-size: 10px; color: #666; text-align: right;">
        Dicetak pada: ' . date('d/m/Y H:i:s') . '
    </div>
</body>
</html>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Senarai_Peserta_Berkumpulan.pdf", ["Attachment" => true]);
?>
