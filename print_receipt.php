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
    <table class="group-table">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">NO.</th>
                <th style="width: 35%;">NAMA PESERTA</th>
                <th style="width: 25%;">NO. KP / SIJIL</th>
                <th style="width: 15%; text-align: center;">JARAK</th>
                <th style="width: 20%; text-align: center;">SAIZ BAJU</th>
            </tr>
        </thead>
        <tbody>';
    
    $counter = 1;
    foreach ($group_members as $member) {
        $participant_content .= '
        <tr>
            <td style="text-align: center;">' . $counter++ . '</td>
            <td style="font-weight: bold; color: #333;">' . strtoupper($member['nama_penuh']) . '</td>
            <td>' . $member['ic_number'] . '</td>
            <td style="text-align: center;"><span class="badge">' . $member['distance'] . '</span></td>
            <td style="text-align: center;">' . $member['tshirt_size'] . ' <span style="font-size:10px; color:#777;">(' . $member['tshirt_type'] . ')</span></td>
        </tr>';
    }
    
    $participant_content .= '
        </tbody>
    </table>
    <div class="total-box">
        Jumlah Peserta: <strong>' . count($group_members) . ' Orang</strong>
    </div>';

} else {
    // INDIVIDUAL VIEW HTML (Existing)
    $receipt_title = "RESIT RASMI PENDAFTARAN";
    $participant_content .= '
    <table class="individual-table">
        <tr>
            <td class="label">NAMA PESERTA</td>
            <td class="value"><strong>' . strtoupper($row['nama_penuh']) . '</strong></td>
        </tr>
        <tr>
            <td class="label">NO. KAD PENGENALAN</td>
            <td class="value">' . $row['ic_number'] . '</td>
        </tr>
        <tr>
            <td class="label">NO. TELEFON</td>
            <td class="value">' . $row['no_telefon'] . '</td>
        </tr>
        <tr>
            <td class="label">KATEGORI LARIAN</td>
            <td class="value"><span class="badge">' . $row['distance'] . '</span></td>
        </tr>
        <tr>
            <td class="label">SAIZ BAJU</td>
            <td class="value">' . $row['tshirt_size'] . ' <span style="font-size:12px; color:#666;">(' . $row['tshirt_type'] . ')</span></td>
        </tr>
        <tr>
            <td class="label">STATUS BAYARAN</td>
            <td class="value"><span class="status-badge">LULUS / DIBAYAR</span></td>
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
        @page { margin: 0px; }
        body {
            font-family: "Helvetica", "Arial", sans-serif;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }
        .header-bg {
            background-color: #003366;
            height: 20px;
            width: 100%;
        }
        .container {
            padding: 40px 50px;
        }
        .header-table {
            width: 100%;
            border-bottom: 2px solid #003366;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo-img {
            width: 80px;
            height: auto;
        }
        .org-name {
            font-size: 12px;
            font-weight: bold;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .event-name {
            font-size: 24px;
            font-weight: 900;
            color: #003366;
            margin: 5px 0;
            text-transform: uppercase;
        }
        .receipt-header {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .receipt-title {
            font-size: 22px;
            font-weight: bold;
            color: #003366;
            text-transform: uppercase;
            border-left: 5px solid #d35400;
            padding-left: 15px;
        }
        .receipt-meta {
            text-align: right;
            font-size: 12px;
            color: #555;
            line-height: 1.6;
        }
        
        /* Group Table Styles */
        .group-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }
        .group-table th {
            background-color: #003366;
            color: #fff;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
        }
        .group-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            color: #333;
        }
        .group-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        /* Individual Table Styles */
        .individual-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .individual-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
        }
        .individual-table .label {
            width: 35%;
            font-weight: bold;
            color: #555;
            background-color: #f8f9fa;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }
        .individual-table .value {
            width: 65%;
            color: #000;
        }

        /* Components */
        .badge {
            background-color: #e3f2fd;
            color: #0d47a1;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 11px;
            border: 1px solid #bbdefb;
        }
        .status-badge {
            background-color: #28a745;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .total-box {
            text-align: right;
            background-color: #f0f4f8;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
            color: #003366;
            margin-bottom: 20px;
        }
        
        /* Footer & Notes */
        .note-box {
            background-color: #fff8e1;
            border-left: 4px solid #ffc107;
            padding: 15px;
            font-size: 11px;
            color: #856404;
            margin-top: 30px;
            line-height: 1.5;
        }
        .footer {
            position: fixed;
            bottom: 40px;
            left: 50px;
            right: 50px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        .watermark {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(0, 51, 102, 0.05);
            font-weight: bold;
            z-index: -1;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="header-bg"></div>
    
    <div class="watermark">RUN FOR PEACE</div>

    <div class="container">
        <!-- Header -->
        <table class="header-table">
            <tr>
                <td style="width: 100px; vertical-align: middle;">
                    <img src="' . $logoSrc . '" class="logo-img" alt="Logo">
                </td>
                <td style="vertical-align: middle; padding-left: 20px;">
                    <div class="org-name">Persekutuan Pengakap Malaysia Daerah Tangkak</div>
                    <div class="event-name">RUN FOR PEACE 2026</div>
                    <div style="font-size: 11px; color: #777;">Jalan Hospital, 84900 Tangkak, Johor</div>
                </td>
            </tr>
        </table>

        <!-- Receipt Header & Meta -->
        <div class="receipt-header">
            <div style="display: table-cell; vertical-align: middle;">
                <div class="receipt-title">' . $receipt_title . '</div>
            </div>
            <div style="display: table-cell; vertical-align: middle; text-align: right;">
                <div class="receipt-meta">
                    <strong>NO. RESIT:</strong> <span style="font-family: monospace; font-size: 14px; color: #000;">RFP-' . ($is_group_view ? 'GRP-' . substr(md5($row['payment_proof']), 0, 6) : str_pad($row['id'], 5, '0', STR_PAD_LEFT)) . '</span><br>
                    <strong>TARIKH:</strong> ' . date('d/m/Y', strtotime($row['reg_date'])) . '<br>
                    <strong>MASA:</strong> ' . date('h:i A', strtotime($row['reg_date'])) . '
                </div>
            </div>
        </div>

        <!-- Participant Content -->
        ' . $participant_content . '

        <!-- Important Notes -->
        <div class="note-box">
            <strong>PENTING:</strong><br>
            1. Sila simpan resit ini (digital atau cetakan) sebagai bukti pendaftaran yang sah.<br>
            2. Resit ini <u>WAJIB</u> dikemukakan semasa pengambilan Race Kit (Race Kit Collection).<br>
            3. Penganjur berhak meminta pengenalan diri bagi tujuan pengesahan.
        </div>

        <!-- Footer -->
        <div class="footer">
            Cetakan Komputer | Tandatangan tidak diperlukan.<br>
            &copy; 2026 Persekutuan Pengakap Malaysia Daerah Tangkak. Hak Cipta Terpelihara.
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