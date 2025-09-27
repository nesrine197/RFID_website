<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <div class="login_doctor">
        <form action="../patient/view.php"   method="post">
  <h2>Connexion Patient</h2>
  <label for="uid">Votre identifiant (UID) :</label>
  <input type="text" id="uid" name="UID" required>

  <button type="submit">Accéder</button>
</form>

        </div>
    </main>
</body>
</html>