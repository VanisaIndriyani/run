<?php
require 'vendor/autoload.php';
include 'db_connect.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// 1. Get Participant ID
if (!isset($_GET['id'])) {
    die("ID Peserta tidak ditemui.");
}
$id = $_GET['id'];
$source = $_GET['source'] ?? 'individual';
$table = ($source === 'group') ? 'group_participants' : 'participants';

// 2. Fetch Participant Data
$sql = "SELECT * FROM $table WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Peserta tidak dijumpai.");
}
$row = $result->fetch_assoc();

// 2.5 Fetch Group Members (if source is group)
$group_members = [];
$is_group_view = false;

if ($source === 'group' && !empty($row['payment_proof'])) {
    $proof = $row['payment_proof'];
    $sql_group = "SELECT * FROM group_participants WHERE payment_proof = ? ORDER BY id ASC";
    $stmt_group = $conn->prepare($sql_group);
    $stmt_group->bind_param("s", $proof);
    $stmt_group->execute();
    $result_group = $stmt_group->get_result();
    
    if ($result_group->num_rows > 1) {
        $is_group_view = true;
        while ($m = $result_group->fetch_assoc()) {
            $group_members[] = $m;
        }
    } else {
        $group_members[] = $row;
    }
} else {
    $group_members[] = $row;
}

// 3. Setup Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // Allow images
$dompdf = new Dompdf($options);

// 4. Create HTML Content for Receipt
// Use absolute path for images to ensure Dompdf finds them
$logoPath = 'img/logo.jpg';
$logoData = base64_encode(file_get_contents($logoPath));
$logoSrc = 'data:image/jpeg;base64,' . $logoData;

// Prepare Participant Details Section
$participant_content = '';

if ($is_group_view) {
    // GROUP VIEW HTML
    $receipt_title = "RESIT PENDAFTARAN BERKUMPULAN";
    $participant_content .= '
    <table class="info-table">
        <thead>
            <tr>
                <th style="width: 5%;">NO.</th>
                <th style="width: 40%;">NAMA PESERTA</th>
                <th style="width: 25%;">NO. KP / SIJIL</th>
                <th style="width: 15%;">KATEGORI</th>
                <th style="width: 15%;">SAIZ BAJU</th>
            </tr>
        </thead>
        <tbody>';
    
    $counter = 1;
    foreach ($group_members as $member) {
        $participant_content .= '
        <tr>
            <td style="text-align: center;">' . $counter++ . '</td>
            <td>' . strtoupper($member['nama_penuh']) . '</td>
            <td>' . $member['ic_number'] . '</td>
            <td><strong style="color: #d35400;">' . $member['distance'] . '</strong></td>
            <td>' . $member['tshirt_size'] . ' <span style="font-size:10px; color:#666;">(' . $member['tshirt_type'] . ')</span></td>
        </tr>';
    }
    
    $participant_content .= '
        </tbody>
    </table>
    <div style="text-align: right; margin-top: 10px; font-size: 14px;">
        <strong>Jumlah Peserta:</strong> ' . count($group_members) . ' Orang
    </div>';

} else {
    // INDIVIDUAL VIEW HTML (Existing)
    $receipt_title = "RESIT RASMI PENDAFTARAN";
    $participant_content .= '
    <table class="info-table">
        <tr>
            <th>NAMA PESERTA</th>
            <td>' . strtoupper($row['nama_penuh']) . '</td>
        </tr>
        <tr>
            <th>NO. KAD PENGENALAN</th>
            <td>' . $row['ic_number'] . '</td>
        </tr>
        <tr>
            <th>NO. TELEFON</th>
            <td>' . $row['no_telefon'] . '</td>
        </tr>
        <tr>
            <th>KATEGORI LARIAN</th>
            <td><strong style="color: #d35400;">' . $row['distance'] . '</strong></td>
        </tr>
        <tr>
            <th>SAIZ BAJU</th>
            <td>' . $row['tshirt_size'] . ' <span style="font-size:12px; color:#666;">(' . $row['tshirt_type'] . ')</span></td>
        </tr>
        <tr>
            <th>STATUS BAYARAN</th>
            <td><span class="status-badge">LULUS / DIBAYAR</span></td>
        </tr>
    </table>';
}

$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resit Pendaftaran - Run For Peace 2026</title>
    <style>
        body {
            font-family: "Helvetica", "Arial", sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 40px;
            background: #fff;
        }
        .header-table {
            width: 100%;
            border-bottom: 3px solid #003366;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo-cell {
            width: 100px;
            vertical-align: middle;
        }
        .logo-img {
            width: 90px;
            height: auto;
        }
        .title-cell {
            vertical-align: middle;
            text-align: left;
            padding-left: 15px;
        }
        .org-name {
            font-size: 14px;
            font-weight: bold;
            color: #555;
            text-transform: uppercase;
        }
        .event-name {
            font-size: 26px;
            font-weight: 900;
            color: #003366;
            margin: 5px 0;
            letter-spacing: 1px;
        }
        .receipt-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #003366;
            margin-bottom: 10px;
            text-transform: uppercase;
            border: 1px solid #003366;
            padding: 8px;
            display: inline-block;
            background-color: #f0f4f8;
        }
        .center-wrapper {
            text-align: center;
            margin-bottom: 30px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .info-table th {
            text-align: left;
            padding: 12px;
            background-color: #003366;
            color: #fff;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
        }
        .info-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            color: #333;
            font-size: 14px;
        }
        .info-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-badge {
            font-size: 12px;
            color: #fff;
            background-color: #28a745;
            padding: 4px 8px;
            border-radius: 4px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .note-box {
            background-color: #fff8e1;
            border: 1px solid #ffeeba;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            font-size: 13px;
            margin-top: 20px;
            text-align: center;
        }
        .receipt-meta {
            text-align: right;
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <img src="' . $logoSrc . '" class="logo-img" alt="Logo">
                </td>
                <td class="title-cell">
                    <div class="org-name">Persekutuan Pengakap Malaysia Daerah Tangkak</div>
                    <div class="event-name">RUN FOR PEACE 2026</div>
                    <div style="font-size: 12px; color: #777;">Tangkak, Johor Darul Takzim</div>
                </td>
            </tr>
        </table>

        <!-- Receipt Info -->
        <div class="receipt-meta">
            <strong>No. Resit:</strong> RFP-' . ($is_group_view ? 'GRP-' . substr(md5($row['payment_proof']), 0, 6) : str_pad($row['id'], 5, '0', STR_PAD_LEFT)) . '<br>
            <strong>Tarikh:</strong> ' . date('d/m/Y H:i A', strtotime($row['reg_date'])) . '
        </div>

        <div class="center-wrapper">
            <div class="receipt-title">' . $receipt_title . '</div>
        </div>

        <!-- Participant Content -->
        ' . $participant_content . '

        <!-- Important Notes -->
        <div class="note-box">
            <strong>PENTING:</strong><br>
            Sila simpan resit ini (digital atau cetakan) sebagai bukti pendaftaran.<br>
            Resit ini <u>WAJIB</u> dikemukakan semasa pengambilan Race Kit.
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Ini adalah cetakan komputer. Tandatangan tidak diperlukan.</p>
            <p>&copy; 2026 Persekutuan Pengakap Malaysia Daerah Tangkak | Run For Peace 2026</p>
        </div>
    </div>
</body>
</html>';

// 5. Load HTML and Render
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// 6. Output PDF (Download)
$dompdf->stream("Resit_RFP_" . ($is_group_view ? 'GRP' : $row['id']) . ".pdf", ["Attachment" => true]); // true = force download
?>