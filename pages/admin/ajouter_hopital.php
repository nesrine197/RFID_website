<?php
$pdo = new PDO("mysql:host=localhost;dbname=medical_rfid_system;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $address = trim($_POST["address"]);
    $username = trim($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $phone = trim($_POST["phone"]);

    $stmt = $pdo->prepare("INSERT INTO hospitals (name, address, phone, username, password) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $address, $phone, $username, $password])) {
        $message = " Hôpital ajouté avec succès.";
        $success = true;
    } else {
        $message = " Échec de l'ajout de l'hôpital.";
        $success = false;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Résultat - Ajouter Hôpital</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f1f6f8;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 80px auto;
      background: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      text-align: center;
    }
    .message {
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 25px;
      font-size: 18px;
      font-weight: bold;
      color: white;
    }
    .success {
      background-color: #4caf50;
    }
    .error {
      background-color: #f44336;
    }
    a.button {
      text-decoration: none;
      background-color: #009688;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      font-weight: bold;
      transition: background 0.3s ease;
    }
    a.button:hover {
      background-color: #00796b;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="message <?php echo $success ? 'success' : 'error'; ?>">
      <?php echo htmlspecialchars($message); ?>
    </div>
    <a class="button" href="dashboard.php">⬅ Retour</a>
  </div>
</body>
</html>
