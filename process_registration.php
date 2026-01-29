<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_penuh = strtoupper(trim($_POST['nama_penuh']));
    $ic_number = trim($_POST['ic_number']);
    $jantina = $_POST['jantina'];
    $umur = intval($_POST['umur']);
    $no_telefon = trim($_POST['no_telefon']);
    $kaum = $_POST['kaum'];
    
    // Handle Agama Dropdown
    $agama = $_POST['agama_select'];
    if ($agama == 'Lain-lain' && !empty($_POST['agama_lain'])) {
        $agama = strtoupper(trim($_POST['agama_lain']));
    }
    
    $distance = $_POST['jarak_larian'];
    
    // Handle Tshirt Size
    $tshirt_size = "";
    $tshirt_type = "Adult"; // Default

    if (isset($_POST['tshirt_size'])) {
        // New single dropdown logic
        $tshirt_size = $_POST['tshirt_size'];
        // Determine type: Numeric sizes (24-34) are kids
        if (is_numeric($tshirt_size)) {
            $tshirt_type = 'Kid';
        } else {
            $tshirt_type = 'Adult';
        }
    } else {
        // Old split logic (fallback)
        $saiz_kids = isset($_POST['saiz_kids']) ? $_POST['saiz_kids'] : '-';
        $saiz_adult = isset($_POST['saiz_adult']) ? $_POST['saiz_adult'] : '-';
        
        if ($saiz_kids !== '-' && $saiz_kids !== '') {
            $tshirt_size = $saiz_kids;
            $tshirt_type = 'Kid';
        } else {
            $tshirt_size = $saiz_adult;
            $tshirt_type = 'Adult';
        }
    }
    
    $nama_sekolah = trim($_POST['nama_sekolah']);
    $kod_sekolah = isset($_POST['kod_sekolah']) ? trim($_POST['kod_sekolah']) : '';
    $ec_name = trim($_POST['ec_name']);
    $ec_number = trim($_POST['ec_number']);
    
    $payment_method = $_POST['payment_method'];
    
    // Handle Payment Proof (Text Input or File)
    $payment_proof = "";
    $payment_status = "Pending";
    
    if (isset($_POST['payment_ref']) && !empty($_POST['payment_ref'])) {
        $payment_proof = trim($_POST['payment_ref']);
        $payment_status = "Berjaya";
    } elseif (isset($_FILES['payment_receipt']) && $_FILES['payment_receipt']['error'] == 0) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_extension = pathinfo($_FILES["payment_receipt"]["name"], PATHINFO_EXTENSION);
        $new_filename = "receipt_" . time() . "_" . uniqid() . "." . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["payment_receipt"]["tmp_name"], $target_file)) {
            $payment_proof = $new_filename;
            $payment_status = "Berjaya";
        }
    }

    // Basic Validation
    $errors = [];
    if (empty($nama_penuh)) $errors[] = "Nama Penuh diperlukan.";
    if (empty($ic_number)) $errors[] = "No Kad Pengenalan diperlukan.";
    if (empty($jantina)) $errors[] = "Jantina diperlukan.";
    if (empty($umur)) $errors[] = "Umur diperlukan.";
    if (empty($kaum)) $errors[] = "Kaum diperlukan.";
    if (empty($agama)) $errors[] = "Agama diperlukan.";
    if (empty($no_telefon)) $errors[] = "No Telefon diperlukan.";
    if (empty($nama_sekolah)) $errors[] = "Nama Sekolah diperlukan (atau '-' jika tidak berkenaan).";
    if (empty($distance)) $errors[] = "Jarak Larian diperlukan.";
    if (empty($tshirt_size)) $errors[] = "Saiz Baju diperlukan.";
    if (empty($ec_name)) $errors[] = "Nama Kecemasan diperlukan.";
    if (empty($ec_number)) $errors[] = "No Telefon Kecemasan diperlukan.";
    if (empty($payment_proof)) $errors[] = "Bukti Pembayaran diperlukan.";

    if (!empty($errors)) {
        $error_message = implode("<br>", $errors);
        die("<div style='font-family: Arial; padding: 20px; text-align: center; border: 1px solid red; background: #ffe6e6; color: red; border-radius: 10px; max-width: 600px; margin: 50px auto;'>
                <h3>Sila lengkapkan butiran berikut:</h3>
                <p>$error_message</p>
                <button onclick='history.back()' style='padding: 10px 20px; background: #333; color: #fff; border: none; border-radius: 5px; cursor: pointer;'>Kembali</button>
             </div>");
    }

    $stmt = $conn->prepare("INSERT INTO participants (nama_penuh, ic_number, jantina, umur, kaum, agama, no_telefon, nama_sekolah, kod_sekolah, distance, tshirt_size, tshirt_type, ec_name, ec_number, payment_method, payment_proof, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisssssssssssss", $nama_penuh, $ic_number, $jantina, $umur, $kaum, $agama, $no_telefon, $nama_sekolah, $kod_sekolah, $distance, $tshirt_size, $tshirt_type, $ec_name, $ec_number, $payment_method, $payment_proof, $payment_status);

    if ($stmt->execute()) {
        header("Location: success.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
