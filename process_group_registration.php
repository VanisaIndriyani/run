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
        $payment_status = "Berjaya"; // Default status
        
        // Validate Payment Proof
        if (empty($payment_proof)) {
            die("<div style='font-family: Arial; padding: 20px; text-align: center; border: 1px solid red; background: #ffe6e6; color: red; border-radius: 10px; max-width: 600px; margin: 50px auto;'>
                    <h3>Ralat Pembayaran:</h3>
                    <p>Bukti Pembayaran diperlukan.</p>
                    <button onclick='history.back()' style='padding: 10px 20px; background: #333; color: #fff; border: none; border-radius: 5px; cursor: pointer;'>Kembali</button>
                 </div>");
        }

        $stmt = $conn->prepare("INSERT INTO group_participants (nama_penuh, ic_number, jantina, umur, race, agama, no_telefon, nama_sekolah, kod_sekolah, distance, tshirt_size, tshirt_type, ec_name, ec_number, payment_method, payment_proof, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        foreach ($participants as $index => $p) {
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

            // Validation Per Participant
            $errors = [];
            $p_num = $index + 1;
            if (empty($nama_penuh)) $errors[] = "Peserta $p_num: Nama Penuh diperlukan.";
            if (empty($ic_number)) $errors[] = "Peserta $p_num: No Kad Pengenalan diperlukan.";
            if (empty($jantina)) $errors[] = "Peserta $p_num: Jantina diperlukan.";
            if (empty($umur)) $errors[] = "Peserta $p_num: Umur diperlukan.";
            if (empty($race)) $errors[] = "Peserta $p_num: Kaum diperlukan.";
            if (empty($agama)) $errors[] = "Peserta $p_num: Agama diperlukan.";
            if (empty($no_telefon)) $errors[] = "Peserta $p_num: No Telefon diperlukan.";
            if (empty($nama_sekolah)) $errors[] = "Peserta $p_num: Nama Sekolah diperlukan (atau '-' jika tidak berkenaan).";
            if (empty($distance)) $errors[] = "Peserta $p_num: Jarak Larian diperlukan.";
            if (empty($tshirt_size)) $errors[] = "Peserta $p_num: Saiz Baju diperlukan.";
            if (empty($ec_name)) $errors[] = "Peserta $p_num: Nama Kecemasan diperlukan.";
            if (empty($ec_number)) $errors[] = "Peserta $p_num: No Telefon Kecemasan diperlukan.";

            if (!empty($errors)) {
                $error_message = implode("<br>", $errors);
                die("<div style='font-family: Arial; padding: 20px; text-align: center; border: 1px solid red; background: #ffe6e6; color: red; border-radius: 10px; max-width: 600px; margin: 50px auto;'>
                        <h3>Sila lengkapkan butiran peserta:</h3>
                        <p>$error_message</p>
                        <button onclick='history.back()' style='padding: 10px 20px; background: #333; color: #fff; border: none; border-radius: 5px; cursor: pointer;'>Kembali</button>
                     </div>");
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
