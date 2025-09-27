<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <title>Détails du Patient</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f7f9;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 700px;
      margin: 50px auto;
      background: #ffffff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 120, 130, 0.2);
      border-top: 8px solid #009688;
    }

    h2 {
      color: #009688;
      margin-bottom: 20px;
      text-align: center;
    }

    p {
      font-size: 16px;
      margin: 10px 0;
    }

    strong {
      color: #00796b;
    }

    img {
      border-radius: 8px;
      margin-top: 10px;
      max-width: 100%;
      height: auto;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }

    a {
      display: inline-block;
      margin-top: 15px;
      text-decoration: none;
      color: #fff;
      background: #009688;
      padding: 10px 20px;
      border-radius: 5px;
      transition: background 0.3s ease;
    }

    a:hover {
      background: #00796b;
    }

    .message {
      text-align: center;
      color: #f44336;
      font-weight: bold;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php 
    $conn = new mysqli("localhost", "root", "", "medical_rfid_system");

    if ($conn->connect_error) {
        echo "<div class='message'>Échec de la connexion à la base de données.</div>";
        exit();
    }

    if (isset($_POST['UID'])) {
        $UID = $_POST['UID'];

        $stmt = $conn->prepare("SELECT * FROM patients WHERE UID = ?");
        $stmt->bind_param("s", $UID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $patient = $result->fetch_assoc();

            echo "<h2>Détails du patient</h2>";
            echo "<p><strong>Nom:</strong> " . htmlspecialchars($patient['name']) . "</p>";
            echo "<p><strong>Âge:</strong> " . htmlspecialchars($patient['age']) . "</p>";
            echo "<p><strong>Groupe sanguin:</strong> " . htmlspecialchars($patient['blood_type']) . "</p>";
            echo "<p><strong>Diagnostic:</strong> " . nl2br(htmlspecialchars($patient['diagnosis'])) . "</p>";

            if (!empty($patient['image_path'])) {
                echo "<p><strong>Image:</strong><br><img src='" . htmlspecialchars($patient['image_path']) . "' alt='Image du patient'></p>";
            }

if (!empty($patient['pdf_path'])) {
    echo '<p><a href="' . htmlspecialchars($patient['pdf_path']) . '" target="_blank"><i class="fa-solid fa-file-pdf"></i> Voir le dossier PDF</a></p>';
}


        } else {
            echo "<div class='message'>❌ Aucun patient trouvé avec ce UID.</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='message'>⚠️ UID non fourni.</div>";
    }

    $conn->close();
    ?>
  </div>
</body>
</html>

