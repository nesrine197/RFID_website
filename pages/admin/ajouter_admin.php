<?php  
$conn = new mysqli("localhost", "root", "", "medical_rfid_system");

$message = "";
$redirectScript = "";

// Check connection
if ($conn->connect_error) {
    die("<p class='error'>❌ Échec de la connexion à la base de données: " . htmlspecialchars($conn->connect_error) . "</p>");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $name     = trim($_POST['name'] ?? '');

    if (!empty($username) && !empty($password) && !empty($name)) {

        // Check if username already exists
        $checkStmt = $conn->prepare("SELECT admin_id FROM admins WHERE username = ?");
        if ($checkStmt) {
            $checkStmt->bind_param("s", $username);
            $checkStmt->execute();
            $checkStmt->store_result();

            if ($checkStmt->num_rows > 0) {
                $message = "<p class='error'>❌ Nom d'utilisateur déjà utilisé. Veuillez en choisir un autre.</p>";
                $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO admins (username, password, name) VALUES (?, ?, ?)");

                if ($stmt) {
                    $stmt->bind_param("sss", $username, $hashedPassword, $name);

                    if ($stmt->execute()) {
                        $message = "<p class='success'>✅ Administrateur ajouté avec succès.</p>";
                        $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 2000);</script>";
                    } else {
                        $message = "<p class='error'>❌ Une erreur est survenue: " . htmlspecialchars($stmt->error) . "</p>";
                        $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
                    }

                    $stmt->close();
                } else {
                    $message = "<p class='error'>❌ Erreur lors de la préparation de la requête (INSERT).</p>";
                    $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
                }
            }

            $checkStmt->close();
        } else {
            $message = "<p class='error'>❌ Erreur lors de la préparation de la requête (SELECT).</p>";
            $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
        }

    } else {
        $message = "<p class='error'>❌ Tous les champs sont obligatoires.</p>";
        $redirectScript = "<script>setTimeout(() => { window.history.back(); }, 3000);</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?= $message ?>
    <?= $redirectScript ?>
</body>
</html>
