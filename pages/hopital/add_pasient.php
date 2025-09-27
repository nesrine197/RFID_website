<?php 
/*session_start();

// Vérification de l'authentification (docteur ou médecin d’hôpital)
if (!isset($_SESSION['doctor_id']) && !isset($_SESSION['hospital_doctor_id'])) {
    header("Location: login.php");
    exit();
}*/

$conn = new mysqli("localhost", "root", "", "medical_rfid_system");
if ($conn->connect_error) {
    die("<p class='error'>❌ Échec de la connexion : " . htmlspecialchars($conn->connect_error) . "</p>");
}

$msg = "";
$redirectScript = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $UID = $conn->real_escape_string($_POST['UID']);
    $name = $conn->real_escape_string($_POST['name']);
    $age = (int)$_POST['age'];
    $blood_type = $conn->real_escape_string($_POST['blood_type']);
    $diagnosis = $conn->real_escape_string($_POST['diagnosis']);
    $now = date("Y-m-d H:i:s");

    // Téléchargement de l'image
    $image_path = NULL;
    if (!empty($_FILES['image']['name'])) {
        $image_path = 'uploads/images/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }

    // Téléchargement du fichier PDF
    $pdf_path = NULL;
    if (!empty($_FILES['pdf']['name'])) {
        $pdf_path = 'uploads/pdfs/' . basename($_FILES['pdf']['name']);
        move_uploaded_file($_FILES['pdf']['tmp_name'], $pdf_path);
    }

    // Identifiants du médecin
    $doctor_id = $_SESSION['doctor_id'] ?? NULL;
    $hospital_doctor_id = $_SESSION['hospital_doctor_id'] ?? NULL;

    // Vérification d'unicité de l'UID
    $checkStmt = $conn->prepare("SELECT patient_id FROM patients WHERE UID = ?");
    $checkStmt->bind_param("s", $UID);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        $msg = "<p class='error'>❌ Cet identifiant UID est déjà utilisé. Veuillez en choisir un autre.</p>";
        $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
    } else {
        // Insertion des données
        $stmt = $conn->prepare("INSERT INTO patients (UID, name, age, blood_type, diagnosis, last_diagnosis_date, image_path, pdf_path, doctor_id, hospital_doctor_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssssii", $UID, $name, $age, $blood_type, $diagnosis, $now, $image_path, $pdf_path, $doctor_id, $hospital_doctor_id);

        if ($stmt->execute()) {
            $msg = "<p class='success'>✅ Le dossier du patient a été enregistré avec succès.</p>";
            $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
        } else {
            $msg = "<p class='error'>❌ Une erreur est survenue lors de l'enregistrement : " . htmlspecialchars($stmt->error) . "</p>";
            $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
        }

        $stmt->close();
    }

    $checkStmt->close();
}

$conn->close();

// Affichage HTML
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            text-align: center;
        }
        .success {
            color: #2e7d32;
            background-color: #e8f5e9;
            padding: 15px;
            border-radius: 8px;
            font-weight: bold;
            border: 1px solid #c8e6c9;
            margin-bottom: 10px;
        }
        .error {
            color: #c62828;
            background-color: #ffebee;
            padding: 15px;
            border-radius: 8px;
            font-weight: bold;
            border: 1px solid #ef9a9a;
            margin-bottom: 10px;
        }
        .redirect-info {
            font-size: 14px;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class='container'>
        $msg
        <p class='redirect-info'>🔁 Redirection automatique dans quelques secondes...</p>
    </div>
    $redirectScript
</body>
</html>";
?>
