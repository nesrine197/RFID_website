<?php
session_start();

$host = "localhost";
$dbname = "medical_rfid_system";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Échec de connexion à la base de données: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    echo "🔍 Checking admin...<br>"; var_dump($admin); echo "<br>"; if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin;
        header("Location: ../admin/dashboard.php");
        exit;
    }

    // 2. Vérifier dans la table des doctors
    $stmt = $pdo->prepare("SELECT * FROM doctors WHERE username = ?");
    $stmt->execute([$username]);
    $doctor = $stmt->fetch();

    echo "🔍 Checking doctor...<br>"; var_dump($doctor); echo "<br>"; if ($doctor && password_verify($password, $doctor['password'])) {
        $_SESSION['doctor'] = $doctor;
        header("Location: ../doctor/dashboard.php");
        exit;
    }

    // 3. Vérifier dans la table des hospitals
    $stmt = $pdo->prepare("SELECT * FROM hospitals WHERE username = ?");
    $stmt->execute([$username]);
    $hospital = $stmt->fetch();

    echo "🔍 Checking hospital...<br>"; var_dump($hospital); echo "<br>"; if ($hospital && password_verify($password, $hospital['password'])) {
        $_SESSION['hospital'] = $hospital;
        header("Location: ../hopital/dashboarde_hopital_admin.php");
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM hospital_doctors WHERE username = ?");
    $stmt->execute([$username]);
    $hospitalDoctor = $stmt->fetch();

    echo "🔍 Checking hospitalDoctor...<br>"; var_dump($hospitalDoctor); echo "<br>"; if ($hospitalDoctor && password_verify($password, $hospitalDoctor['password'])) {
        $_SESSION['hospital_doctor'] = $hospitalDoctor;
        header("Location: ../hospital_doctors/dashboarde_doctor_hopital.php");
        exit;
    }

    $_SESSION['login_error'] = "❌ Nom d'utilisateur ou mot de passe incorrect.";
    header("Location: index.php");
    exit;
}
?>