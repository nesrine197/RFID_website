<?php
$conn = new mysqli("localhost", "root", "", "medical_rfid_system");
if ($conn->connect_error) {
    $message = " Échec de la connexion à la base de données.";
    $success = false;
} else {
    $UID = $_POST['UID'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $blood_type = $_POST['blood_type'];
    $diagnosis = $_POST['diagnosis'];

    $image_path = null;
    $pdf_path = null;

    // Upload image si elle existe
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_name = basename($_FILES['image']['name']);
        $image_path = "uploads/images/" . time() . "_" . $image_name;
        move_uploaded_file($image_tmp, $image_path);
    }

    // Upload PDF si existe
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $pdf_tmp = $_FILES['pdf']['tmp_name'];
        $pdf_name = basename($_FILES['pdf']['name']);
        $pdf_path = "uploads/pdf/" . time() . "_" . $pdf_name;
        move_uploaded_file($pdf_tmp, $pdf_path);
    }

    $sql = "UPDATE patients SET name=?, age=?, blood_type=?, diagnosis=?";
    $params = [$name, $age, $blood_type, $diagnosis];
    $types = "siss";

    if ($image_path !== null) {
        $sql .= ", image_path=?";
        $params[] = $image_path;
        $types .= "s";
    }

    if ($pdf_path !== null) {
        $sql .= ", pdf_path=?";
        $params[] = $pdf_path;
        $types .= "s";
    }

    $sql .= " WHERE UID=?";
    $params[] = $UID;
    $types .= "s";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $message = "Les données du patient ont été mises à jour avec succès.";
        $success = true;
    } else {
        $message = " Erreur lors de la mise à jour : " . $stmt->error;
        $success = false;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Résultat de la modification</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #eef4f5;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 60px auto;
      background: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      text-align: center;
    }
    .message {
      font-size: 18px;
      font-weight: bold;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 30px;
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
      background: #009688;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      transition: background 0.3s ease;
    }
    a.button:hover {
      background: #00796b;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="message <?php echo $success ? 'success' : 'error'; ?>">
      <?php echo htmlspecialchars($message); ?>
    </div>
    <?php if (isset($UID)): ?>
      <a class="button" href="search_pasient.php?UID=<?php echo urlencode($UID); ?>"> Retour aux détails du patient</a>
    <?php endif; ?>
  </div>
</body>
</html>

