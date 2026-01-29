<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Handle Payment Proof (Text Input or File)
    $payment_proof = "";
    $payment_method = $_POST['payment_method'];

    if (isset($_POST['payment_ref']) && !empty($_POST['payment_ref'])) {
        $payment_proof = trim($_POST['payment_ref']);
    } elseif (isset($_FILES['payment_receipt']) && $_FILES['payment_receipt']['error'] == 0) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_extension = pathinfo($_FILES["payment_receipt"]["name"], PATHINFO_EXTENSION);
        $new_filename = "group_receipt_" . time() . "_" . uniqid() . "." . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["payment_receipt"]["tmp_name"], $target_file)) {
            $payment_proof = $new_filename;
        }
    }

    // 2. Process Participants
    if (isset($_POST['participants']) && is_array($_POST['participants'])) {
        $participants = $_POST['participants'];
        $payment_status = "Pending"; // Default status
        
        $stmt = $conn->prepare("INSERT INTO group_participants (nama_penuh, ic_number, jantina, umur, race, agama, no_telefon, nama_sekolah, kod_sekolah, distance, tshirt_size, tshirt_type, ec_name, ec_number, payment_method, payment_proof, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        foreach ($participants as $p) {
            $nama_penuh = strtoupper(trim($p['name']));
            $ic_number = trim($p['ic']);
            $jantina = $p['gender'];
            $umur = intval($p['age']);
            $no_telefon = trim($p['phone']);
            $race = $p['race'];
            $agama = $p['religion'];
            $nama_sekolah = isset($p['school']) ? trim($p['school']) : '';
            $kod_sekolah = isset($p['school_code']) ? trim($p['school_code']) : '';
            $distance = $p['distance'];
            $ec_name = trim($p['ec_name']);
            $ec_number = trim($p['ec_phone']);

            // Determine Tshirt Size & Type
            $tshirt_size = "";
            $tshirt_type = "Adult"; // Default

            if (isset($p['tshirt_size'])) {
                $tshirt_size = $p['tshirt_size'];
                // Determine type: Numeric sizes (24-34) are kids
                if (is_numeric($tshirt_size)) {
                    $tshirt_type = 'Kid';
                } else {
                    $tshirt_type = 'Adult';
                }
            } else {
                // Fallback for older form submissions
                $size_kid = isset($p['size_kid']) ? $p['size_kid'] : '-';
                $size_adult = isset($p['size_adult']) ? $p['size_adult'] : '-';
                
                if ($size_kid !== '-' && $size_kid !== '') {
                    $tshirt_size = $size_kid;
                    $tshirt_type = 'Kid';
                } else {
                    $tshirt_size = $size_adult;
                    $tshirt_type = 'Adult';
                }
            }

            // Bind and Execute
            $stmt->bind_param("sssisssssssssssss", 
                $nama_penuh, 
                $ic_number, 
                $jantina, 
                $umur, 
                $race, 
                $agama, 
                $no_telefon, 
                $nama_sekolah,
                $kod_sekolah,
                $distance, 
                $tshirt_size, 
                $tshirt_type, 
                $ec_name, 
                $ec_number, 
                $payment_method, 
                $payment_proof,
                $payment_status
            );
            
            $stmt->execute();
        }
        
        $stmt->close();
        $conn->close();
        
        // Redirect to success page
        header("Location: success.php");
        exit();

    } else {
        die("Tiada data peserta dihantar.");
    }
}
?>
