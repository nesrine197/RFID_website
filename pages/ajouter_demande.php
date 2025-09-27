<?php
// الاتصال بقاعدة البيانات
$host = "localhost";
$user = "root"; // غيّر حسب إعداداتك
$pass = "";     // غيّر حسب إعداداتك
$dbname = "medical_rfid_system";

$conn = new mysqli($host, $user, $pass, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Échec de connexion: " . $conn->connect_error);
}

// استقبال البيانات
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$state = $_POST['state'];
$district = $_POST['district'];
$municipality = $_POST['municipality'];
$specialization = $_POST['specialization'];
$email = $_POST['email'];

// إدخال البيانات في الجدول
$sql = "INSERT INTO join_requests (first_name, last_name, state, district, municipality, specialization, email)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $first_name, $last_name, $state, $district, $municipality, $specialization, $email);

if ($stmt->execute()) {
    echo "<script>alert('Demande envoyée avec succès !'); window.location.href='../index.php';</script>";
} else {
    echo "Erreur: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
