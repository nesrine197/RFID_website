<?php 
session_start();

if (!isset($_SESSION['hospital_id'])) {
    die(" Accès non autorisé.");
}

$hospital_id = $_SESSION['hospital_id'];

$conn = new mysqli("localhost", "root", "", "medical_rfid_system");
if ($conn->connect_error) {
    die("<p class='error'> Erreur de connexion : " . htmlspecialchars($conn->connect_error) . "</p>");
}

$msg = "";
$redirectScript = "";

if (
    isset($_POST['name']) &&
    isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['specialization'])
) {
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $specialization = trim($_POST['specialization']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Vérifier si le nom d'utilisateur existe déjà
    $checkStmt = $conn->prepare("SELECT id FROM hospital_doctors WHERE username = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        $msg = "<p class='error'> Ce nom d'utilisateur est déjà utilisé. Veuillez en choisir un autre.</p>";
        $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
    } else {
        // Ajouter le médecin
        $stmt = $conn->prepare("INSERT INTO hospital_doctors (hospital_id, username, password, name, specialization) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $hospital_id, $username, $hashed_password, $name, $specialization);

        if ($stmt->execute()) {
            $msg = "<p class='success'> Le médecin a été ajouté avec succès.</p>";
            $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
        } else {
            $msg = "<p class='error'> Une erreur s'est produite lors de l'ajout : " . htmlspecialchars($stmt->error) . "</p>";
            $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
        }

        $stmt->close();
    }

    $checkStmt->close();
} else {
    $msg = "<p class='error'> Tous les champs sont requis.</p>";
    $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
}

$conn->close();

echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>Résultat</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
        }
        .success {
            color: #2e7d32;
            background-color: #e8f5e9;
            padding: 15px;
            border: 1px solid #c8e6c9;
            border-radius: 8px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .error {
            color: #c62828;
            background-color: #ffebee;
            padding: 15px;
            border: 1px solid #ef9a9a;
            border-radius: 8px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .redirect-info {
            font-size: 14px;
            color: #666;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class='container'>
        $msg
        <p class='redirect-info'> Redirection automatique dans quelques secondes...</p>
    </div>
    $redirectScript
</body>
</html>";
?>

