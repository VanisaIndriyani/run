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
    $ec_name = trim($_POST['ec_name']);
    $ec_number = trim($_POST['ec_number']);
    
    $payment_method = $_POST['payment_method'];
    
    // Handle File Upload
    $payment_proof = "";
    if (isset($_FILES['payment_receipt']) && $_FILES['payment_receipt']['error'] == 0) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_extension = pathinfo($_FILES["payment_receipt"]["name"], PATHINFO_EXTENSION);
        $new_filename = "receipt_" . time() . "_" . uniqid() . "." . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["payment_receipt"]["tmp_name"], $target_file)) {
            $payment_proof = $new_filename;
        }
    }

    // Basic Validation
    if (empty($nama_penuh) || empty($ic_number) || empty($no_telefon) || empty($tshirt_size)) {
        die("Sila lengkapkan semua butiran wajib.");
    }

    $stmt = $conn->prepare("INSERT INTO participants (nama_penuh, ic_number, jantina, umur, kaum, agama, no_telefon, nama_sekolah, distance, tshirt_size, tshirt_type, ec_name, ec_number, payment_method, payment_proof) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisssssssssss", $nama_penuh, $ic_number, $jantina, $umur, $kaum, $agama, $no_telefon, $nama_sekolah, $distance, $tshirt_size, $tshirt_type, $ec_name, $ec_number, $payment_method, $payment_proof);

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
