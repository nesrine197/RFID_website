<?php
$conn = new mysqli("localhost", "root", "", "medical_rfid_system");

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if (!isset($_GET['UID'])) {
    echo "<p>UID non fourni.</p>";
    exit();
}

$UID = $_GET['UID'];

// Récupérer les données du patient
$stmt = $conn->prepare("SELECT * FROM patients WHERE UID = ?");
$stmt->bind_param("s", $UID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>Aucun patient trouvé.</p>";
    exit();
}

$patient = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier Patient</title>
  <style>
    body {
      font-family: Arial;
      background: #f5f5f5;
    }
    .form-container {
      max-width: 600px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input[type="text"], textarea, input[type="number"], input[type="file"] {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      margin-top: 20px;
      background-color: #009688;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: #00796b;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Modifier les informations du patient</h2>
    <form action="update_patient.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="UID" value="<?php echo htmlspecialchars($UID); ?>">

      <label>Nom :</label>
      <input type="text" name="name" value="<?php echo htmlspecialchars($patient['name']); ?>" required>

      <label>Âge :</label>
      <input type="number" name="age" value="<?php echo htmlspecialchars($patient['age']); ?>" required>

      <label>Groupe sanguin :</label>
      <input type="text" name="blood_type" value="<?php echo htmlspecialchars($patient['blood_type']); ?>">

      <label>Diagnostic :</label>
      <textarea name="diagnosis" rows="4"><?php echo htmlspecialchars($patient['diagnosis']); ?></textarea>

      <label>Nouvelle image (optionnel) :</label>
      <input type="file" name="image">

      <label>Nouveau dossier PDF (optionnel) :</label>
      <input type="file" name="pdf">

      <button type="submit">💾 Enregistrer les modifications</button>
    </form>
  </div>
</body>
</html>
