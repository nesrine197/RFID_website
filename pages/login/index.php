<?php session_start(); ?>
<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Choix d'utilisateur</title>
  <style>
    * {
      box-sizing: border-box;
      padding: 0;
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
font-family: 'Raleway', sans-serif;
  background: linear-gradient(270deg, #e0f7fa,rgb(174, 255, 177),rgb(116, 211, 255), #f1f8e9);
  background-size: 800% 800%;
  animation: gradientBG 20s ease infinite;      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      
    }
@keyframes gradientBG {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}
    main {
      display: flex;
      gap: 30px;
      padding: 40px;
      background-color: #ffffffdd;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .user, .doctor, .admin {
      text-align: center;
      width: 180px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .user:hover, .doctor:hover, .admin:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 15px;
      margin-bottom: 10px;
    }

    a {
      display: block;
      margin-top: 8px;
      font-weight: bold;
      font-size: 1.1rem;
      color: #2c3e50;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    a:hover {
      color: #2980b9;
    }

    @media (max-width: 768px) {
      main {
        flex-direction: column;
        align-items: center;
      }

      .user, .doctor, .admin {
        width: 80%;
      }
    }
  </style>
</head>
<body>
  <main>
    <div class="user">
      <img src="../img/5.webp" alt="">
      <a href="./patient.php">une patiente</a>
    </div>
    <div class="doctor">
      <img src="../img/pexels-thirdman-5327579.jpg" alt="">
      <a href="./doctor.php">un médecin privé</a>
    </div>
    <div class="doctor">
      <img src="../img/pexels-oles-kanebckuu-34911-127873.jpg" alt="">
      <a href="./check_hopital.php">hopital</a>
    </div>
    <div class="admin">
      <img src="../img/pexels-karolina-grabowska-5900027.jpg" alt="">
      <a href="./admin.php">admin</a>
    </div>
  </main>
</body>
</html>