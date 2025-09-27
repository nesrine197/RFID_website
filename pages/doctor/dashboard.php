<?php 
session_start();
if (isset($_SESSION["doctor_id"])) {
    header("Location: ../login/doctor.php");
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
      <button data-section="formSection">Ajouter un patient</button>
      <button data-section="doctorsSection">Recherche un patient</button>

    </div>

    <div class="content">
      <!-- Ajouter médecin -->
      <div id="formSection" class="hidden">
      <h2>Ajouter un patient</h2>
      <form method="POST" action="../hopital/add_pasient.php" enctype="multipart/form-data">
          <label>Numéro de UID:</label>
          <input type="text" name="UID" required>

          <label>Nom complet :</label>
          <input type="text" name="name" required>

          <label>Age:</label>
          <input type="number" name="age" min="0">

          <label>Groupe sanguin:</label>
          <input type="text" name="blood_type">

          <label>Diagnostic:</label>
          <textarea name="diagnosis"></textarea>

          <label>Photos des patients :</label>
          <input type="file" name="image" accept="image/*">

          <label>Fichier PDF:</label>
          <input type="file" name="pdf" accept="application/pdf">

          <button type="submit">Ajouter</button>
      </form>

      </div>

      <div id="doctorsSection" class="hidden">
      <h2>Recherche un patient</h2>
      <form method="GET" action="../hopital/search_pasient.php">
          <label>Numéro de UID:</label>
          <input type="text" name="UID" required>

          <button type="submit">Rechercher</button>
      </form>
</div>

    </div>
  </main>


</body>
</html>
