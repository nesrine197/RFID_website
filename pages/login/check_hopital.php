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
        background-image: url('../img/pexels-oles-kanebckuu-34911-127873.jpg');
        background-size: cover;
    background-position: center;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      
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
    h1{
        font-weight: bold;
      color:rgb(0, 0, 0);
      
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
   
  <h1>Hopital</h1>
    <div class="doctor">
      <img src="../img/pexels-thirdman-5327579.jpg" alt="">
      <a href="./doctor_hopital.php">un médecin </a>
    </div>

    <div class="admin">
      <img src="../img/pexels-karolina-grabowska-5900027.jpg" alt="">
      <a href="./hopital_admin.php">admin</a>
    </div>
  </main>
</body>
</html>