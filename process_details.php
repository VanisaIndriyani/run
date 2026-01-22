<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $participant_id = intval($_POST['participant_id']);
    $saiz_baju = $_POST['saiz_baju'];
    $jarak_larian = $_POST['jarak_larian'];
    $telegram_joined = isset($_POST['telegram_joined']) ? 1 : 0;
    $payment_method = $_POST['payment_method'];

    if (empty($participant_id) || empty($saiz_baju) || empty($jarak_larian)) {
        die("Sila lengkapkan semua butiran wajib.");
    }

    $stmt = $conn->prepare("UPDATE participants SET saiz_baju = ?, jarak_larian = ?, telegram_joined = ?, payment_method = ? WHERE id = ?");
    $stmt->bind_param("ssisi", $saiz_baju, $jarak_larian, $telegram_joined, $payment_method, $participant_id);

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