<?php
include 'db_connect.php';

echo "Seeding group registration with 5 participants...<br>";

// Common data for the group
$payment_method = "Maybank";
$payment_proof = "seeder_receipt_" . time() . ".jpg";
$school = "SMK Tun Mamat";
$ec_name = "Waris Seeder";
$ec_phone = "012-3456789";

// Participants data
$participants = [
    [
        'name' => 'AHMAD ALI BIN ABU',
        'ic' => '900101-01-1234',
        'gender' => 'Lelaki',
        'age' => 34,
        'race' => 'Melayu',
        'religion' => 'Islam',
        'phone' => '019-1111111',
        'distance' => '10KM',
        'tshirt_size' => 'L',
        'tshirt_type' => 'Adult'
    ],
    [
        'name' => 'SITI AMINAH BINTI OMAR',
        'ic' => '950505-01-5678',
        'gender' => 'Perempuan',
        'age' => 29,
        'race' => 'Melayu',
        'religion' => 'Islam',
        'phone' => '019-2222222',
        'distance' => '5KM',
        'tshirt_size' => 'M',
        'tshirt_type' => 'Adult'
    ],
    [
        'name' => 'CHONG WEI HONG',
        'ic' => '880808-01-8888',
        'gender' => 'Lelaki',
        'age' => 36,
        'race' => 'Cina',
        'religion' => 'Buddha',
        'phone' => '019-3333333',
        'distance' => '10KM',
        'tshirt_size' => 'XL',
        'tshirt_type' => 'Adult'
    ],
    [
        'name' => 'MUTHUSAMY A/L RAJU',
        'ic' => '920202-01-2222',
        'gender' => 'Lelaki',
        'age' => 32,
        'race' => 'India',
        'religion' => 'Hindu',
        'phone' => '019-4444444',
        'distance' => '5KM',
        'tshirt_size' => 'L',
        'tshirt_type' => 'Adult'
    ],
    [
        'name' => 'ADIK KECIL BIN AHMAD',
        'ic' => '150101-01-0000',
        'gender' => 'Lelaki',
        'age' => 10,
        'race' => 'Melayu',
        'religion' => 'Islam',
        'phone' => '019-1111111', // Same as father
        'distance' => '5KM',
        'tshirt_size' => '28',
        'tshirt_type' => 'Kid'
    ]
];

$stmt = $conn->prepare("INSERT INTO group_participants (nama_penuh, ic_number, jantina, umur, race, agama, no_telefon, nama_sekolah, distance, tshirt_size, tshirt_type, ec_name, ec_number, payment_method, payment_proof) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$count = 0;
foreach ($participants as $p) {
    $stmt->bind_param("sssisssssssssss", 
        $p['name'], 
        $p['ic'], 
        $p['gender'], 
        $p['age'], 
        $p['race'], 
        $p['religion'], 
        $p['phone'], 
        $school,
        $p['distance'], 
        $p['tshirt_size'], 
        $p['tshirt_type'], 
        $ec_name, 
        $ec_phone, 
        $payment_method, 
        $payment_proof
    );
    
    if ($stmt->execute()) {
        echo "Inserted: " . $p['name'] . "<br>";
        $count++;
    } else {
        echo "Failed to insert: " . $p['name'] . " - Error: " . $stmt->error . "<br>";
    }
}

$stmt->close();
$conn->close();

echo "<br>Seeding completed! Total inserted: $count";
echo "<br><a href='admin_berkumpul.php'>Go to Admin Group List</a>";
?>
