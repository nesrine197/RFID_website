<?php 
$host = "localhost";
$user = "root"; 
$pass = "";     
$dbname = "medical_rfid_system";

$conn = new mysqli($host, $user, $pass, $dbname);

$message = "";
$redirectScript = "";

// Check connection
if ($conn->connect_error) {
    die("<p class='error'>❌ Échec de connexion : " . htmlspecialchars($conn->connect_error) . "</p>");
}

// Get and sanitize inputs
$name = trim($_POST['name'] ?? '');
$username = trim($_POST['username'] ?? '');
$passwordRaw = $_POST['password'] ?? '';
$specialization = trim($_POST['specialization'] ?? '');

if ($name && $username && $passwordRaw && $specialization) {
    // Check if username already exists
    $checkStmt = $conn->prepare("SELECT doctor_id FROM doctors WHERE username = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        // Username taken
        $message = "<p class='error'>❌ Ce nom d'utilisateur est déjà utilisé. Veuillez en choisir un autre.</p>";
        $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
    } else {
        // Proceed to insert
        $password = password_hash($passwordRaw, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO doctors (username, password, name, specialization) VALUES (?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("ssss", $username, $password, $name, $specialization);

            if ($stmt->execute()) {
                $message = "<p class='success'>✅ Médecin ajouté avec succès !</p>";
                $redirectScript = "<script>setTimeout(() => { window.location.href = './dashboard.php'; }, 2000);</script>";
            } else {
                $message = "<p class='error'>❌ Erreur lors de l’ajout : " . htmlspecialchars($stmt->error) . "</p>";
                $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
            }

            $stmt->close();
        } else {
            $message = "<p class='error'>❌ Erreur de préparation de la requête.</p>";
        }
    }

    $checkStmt->close();
} else {
    $message = "<p class='error'>❌ Tous les champs sont obligatoires.</p>";
    $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
}

$conn->close();

// Output page
echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>Résultat</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            text-align: center;
        }
        .success {
            color: #2e7d32;
            background-color: #e8f5e9;
            padding: 15px;
            border-radius: 8px;
            font-weight: 600;
            border: 1px solid #c8e6c9;
            margin-bottom: 15px;
        }
        .error {
            color: #c62828;
            background-color: #ffebee;
            padding: 15px;
            border-radius: 8px;
            font-weight: 600;
            border: 1px solid #ef9a9a;
            margin-bottom: 15px;
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
        $message
        <p class='redirect-info'>🔁 Redirection automatique dans quelques secondes...</p>
    </div>
    $redirectScript
</body>
</html>";
?>
