<?php 
session_start();
if (isset($_SESSION["admin_id"])) {
    header("Location: ../login/admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Panneau Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&family=Lora&family=Playfair+Display&family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>

  </style>
</head>
<body>
<script defer>
document.addEventListener("DOMContentLoaded", function () {
  console.log("Page loaded"); 

  const buttons = document.querySelectorAll(".sidebar button");
  const sections = document.querySelectorAll(".content > div");

  console.log(buttons); 

  buttons.forEach(btn => {
    btn.addEventListener("click", function () {
      const target = this.getAttribute("data-section");
      console.log("Button clicked, showing section:", target); 

      sections.forEach(sec => {
        sec.classList.add("hidden");
      });
      document.getElementById(target).classList.remove("hidden");
    });
  });
});




  </script>
  <header>
    <div class="header_left">
      <h2>Panneau de contrôle Admin</h2>
    </div>
    <div class="header_right">
        <a class="btn" href="../logout.php">Se déconnecter</a>
      
    </div>
  </header>

  <main>
    <div class="sidebar">
      <button data-section="formSection">Ajouter un médecin</button>
      <button data-section="hopitalSection">Ajouter un hopital</button>
      <button data-section="doctorsSection">Afficher les médecins</button>
      <button data-section="hopitalssSection">Afficher les hopitals</button>
      <button data-section="demandessSection">Afficher les demandes</button>
      <button data-section="adminsSection">Ajouter un admine</button>

    </div>

    <div class="content">
      <div id="formSection" class="hidden">
        <h3>Ajouter un médecin</h3>
        <form method="POST" action="ajouter_medecin.php">
    <div class="form-group">
        <label>Nom complet</label>
        <input type="text" name="name" required>
    </div>
    <div class="form-group">
        <label>Nom d'utilisateur</label>
        <input type="text" name="username" required>
    </div>
    <div class="form-group">
        <label>Mot de passe</label>
        <input type="password" name="password" required>
    </div>
    <div class="form-group">
        <label>Spécialité</label>
        <input type="text" name="specialization" required>
    </div>
    <button type="submit">Enregistrer</button>
</form>

      </div>
 <div id="hopitalSection" class="hidden">
<h3>Ajouter un administrateur d'hôpital</h3>
<form method="POST" action="ajouter_hopital.php">
    <div class="form-group">
        <label>Nom complet de l'hôpital</label>
        <input type="text" name="name" required>
    </div>
    <div class="form-group">
        <label>Adresse</label>
        <input type="text" name="address" required>
    </div>
    <div class="form-group">
        <label>Nom d'utilisateur</label>
        <input type="text" name="username" required>
    </div> 
    <div class="form-group">
        <label>Mot de passe</label>
        <input type="password" name="password" required>
    </div>
    <div class="form-group">
        <label>Numéro de téléphone</label>
        <input type="text" name="phone" required>
    </div>
    <button type="submit">Enregistrer</button>
</form>


      </div>
      <div id="hopitalssSection" class="hidden">
     <h3>Liste des hôpitaux</h3>
      <?php
      $pdo = new PDO("mysql:host=localhost;dbname=medical_rfid_system;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->query("SELECT name, address, phone, created_at FROM hospitals");
$hospitals = $stmt->fetchAll(PDO::FETCH_ASSOC);
       if (count($hospitals) > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Téléphone</th>
            <th>Date de création</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($hospitals as $h): ?>
          <tr>
            <td><?= htmlspecialchars($h['name']) ?></td>
            <td><?= htmlspecialchars($h['address']) ?></td>
            <td><?= htmlspecialchars($h['phone']) ?></td>
            <td><?= htmlspecialchars($h['created_at']) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php else: ?>
        <p>Aucun hôpital enregistré.</p>
      <?php endif; ?>
</div>
<div id="doctorsSection" class="hidden">
    <h3>Liste des médecins</h3>
    <?php
    $conn = new mysqli("localhost", "root", "", "medical_rfid_system");
    if ($conn->connect_error) {
        die("Erreur de connexion: " . $conn->connect_error);
    }

    
    $sql = "SELECT doctor_id, name, username, specialization FROM doctors ORDER BY doctor_id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Nom</th><th>Nom d'utilisateur</th><th>Spécialité</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["doctor_id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["username"]. "</td><td>" . $row["specialization"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Aucun médecin trouvé.</p>";
    }

    $conn->close();
    ?>
</div>

      <div id="demandessSection" class="hidden">
      <h3>Liste des demandes d'adhésion</h3>
    <?php
    $conn = new mysqli("localhost", "root", "", "medical_rfid_system");
    if ($conn->connect_error) {
        die("Erreur de connexion: " . $conn->connect_error);
    }

    $sql = "SELECT request_id, first_name, last_name, state, district, municipality, specialization, email, created_at FROM join_requests ORDER BY request_id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Nom</th><th>Wilaya</th><th>Daïra</th><th>Commune</th><th>Spécialité</th><th>Email</th><th>Date</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["request_id"]. "</td><td>" . $row["first_name"]. " " . $row["last_name"]. "</td><td>" . $row["state"]. "</td><td>" . $row["district"]. "</td><td>" . $row["municipality"]. "</td><td>" . $row["specialization"]. "</td><td>" . $row["email"]. "</td><td>" . $row["created_at"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Aucune demande trouvée.</p>";
    }

    $conn->close();
    ?>
      </div>

 <div id="adminsSection" class="hidden">
       <h2>Ajouter un nouvel administrateur</h2>
    
    <form method="POST" action="ajouter_admin.php">
      <label>Nom d'utilisateur :</label>
      <input type="text" name="username" required>

      <label>Mot de passe :</label>
      <input type="password" name="password" required>

      <label>Nom complet :</label>
      <input type="text" name="name" required>

      <button type="submit"> Ajouter Admin</button>
    </form>
</div>
    </div>
  </main>


</body>
</html>
