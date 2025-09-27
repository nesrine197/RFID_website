<?php
session_start();
if (isset($_SESSION['login_error'])) {
    echo "<p style='color:red; text-align:center; font-weight:bold'>" . $_SESSION['login_error'] . "</p>";
    unset($_SESSION['login_error']);
}
?>

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
        <form action="login_check.php" method="post">
  <h2>Connexion Médecin de hopital</h2>
  <label for="username">Nom d'utilisateur :</label>
  <input type="text" id="username" name="username" required>

  <label for="password">Mot de passe :</label>
  <input type="password" id="password" name="password" required>

  <button type="submit" name="login">Se connecter</button>
</form>

        </div>
    </main>
</body>
</html>