<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Festive&family=Roboto:ital,wght@0,100..900;1,100..900&family=Tektur&display=swap" rel="stylesheet">

     <style>
@import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap');

* {
  box-sizing: border-box;
}

html {
  scroll-behavior: smooth;
}

body {
  margin: 0;
  padding: 0;
  font-family: 'Raleway', sans-serif;
 /* background: linear-gradient(270deg,rgb(128, 240, 255),rgb(180, 255, 182), #b3e5fc, #f1f8e9);
  background-size: 800% 800%;
  animation: gradientBG 20s ease infinite;*/
    background-image: url('./img/pexels-oles-kanebckuu-34911-127873.jpg'); 
    background-size: cover;
    background-position: center;
    height: 90vh;
}

@keyframes gradientBG {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

  header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      background-color: #00796b;
      position: fixed;
      width: 100%;
      height: 10vh;
      top: 0;
      z-index: 1000;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      animation: slideDown 1s ease-out;
    }

    .logo_hopecart {
      display: flex;
      justify-content: flex-start;
      align-items: center;
    }

    .logo {
      font-family: "Festive", cursive;
      font-weight: 500;
      color: white;
      font-size: xx-large;
      font-style: normal;
    }

    .buttons {
      display: flex;
      gap: 20px;
    }

    header button {
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      background: linear-gradient(90deg, #ffffff, #80deea);
      border: none;
      border-radius: 20px;
      color: #004d40;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    header button:hover {
      background: #004d40;
      color: #ffffff;
    }
@keyframes slideDown {
  from { top: -60px; opacity: 0; }
  to { top: 0; opacity: 1; }
}


.maine1 {
  display: flex;
  align-items: center;
  justify-content: space-around;
  padding: 100px 40px 60px;
  min-height: 100vh;
  animation: fadeInZoom 1.2s ease-in;
}

@keyframes fadeInZoom {
  from { opacity: 0; transform: scale(0.95); }
  to { opacity: 1; transform: scale(1); }
}

.left {
  flex: 1;
  padding: 20px;
  background-color: rgba(255, 255, 255, 0.85);
  border-radius: 15px;
  animation: slideLeft 1s ease-out;
}

@keyframes slideLeft {
  from { opacity: 0; transform: translateX(-50px); }
  to { opacity: 1; transform: translateX(0); }
}

.left h1 {
  font-size: 48px;
  color: #00796b;
  font-weight: 700;
  margin-bottom: 20px;
}

.left p {
  font-size: 25px;
  color: #333;
  line-height: 1.8;
      font-family: 'Poppins', sans-serif;
  font-weight: 500;

}

.right {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  animation: slideRight 1s ease-out;
}

@keyframes slideRight {
  from { opacity: 0; transform: translateX(50px); }
  to { opacity: 1; transform: translateX(0); }
}

.right img {
  width: 320px;
  height: 320px;
  border-radius: 50%;
  object-fit: cover;
    transition: all 0.4s ease-in-out;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}
.right img:hover{
  width: 330px;
  height: 330px;
    border-radius: 50%;
    box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.61);
}
.maine2 {
  padding: 60px 20px;
  background-color: #004d40;
  animation: fadeIn 2s ease;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.container {
  max-width: 1100px;
  margin: auto;
}

.section {
  background: #ffffff;
  border-radius: 15px;
  padding: 30px;
  margin-bottom: 40px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  animation: fadeInCard 1.5s ease;
  transition: transform 0.3s ease;
}

.section:hover {
  transform: scale(1.02);
}

@keyframes fadeInCard {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

.section img {

    width: 320px;
  height: 320px;
  border-radius: 50%;
  object-fit: cover;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);

}

.section h2 {
  color: #00796b;
  margin-bottom: 15px;
}

.section p {
  font-size: 1.1em;
  line-height: 1.6em;
  color: #333;
}

.cta-button {
  display: inline-block;
  margin-top: 20px;
  padding: 12px 25px;
  background: linear-gradient(90deg, #26a69a, #80cbc4);
  color: white;
  font-weight: bold;
  text-decoration: none;
  border-radius: 8px;
  transition: background 0.3s ease, transform 0.2s ease;
}

.cta-button:hover {
  background: #004d40;
  transform: scale(1.05);
}

.footer {
  background-color: #00796b;
  color: white;
  text-align: center;
  padding: 15px 10px;
  font-size: 16px;
  font-weight: 500;
  letter-spacing: 0.5px;
  animation: fadeIn 2s ease;
}

.footer i {
  margin-right: 8px;
}
.bounce-title {
  text-align: center;
  margin-bottom: 20px;
}

.bounce-title span {
  font-size: 60px;
  color: #00796b;
  font-family: 'Raleway', sans-serif;
  text-transform: uppercase;
  display: inline-block;
  transform: rotateY(0deg);
  transition: 0.5s;
  animation: bounce 0.4s ease infinite alternate;
  position: relative;
  font-weight: 700;
}

.bounce-title span:nth-child(1) { animation-delay: 0s; }
.bounce-title span:nth-child(2) { animation-delay: 0.1s; }
.bounce-title span:nth-child(3) { animation-delay: 0.2s; }
.bounce-title span:nth-child(4) { animation-delay: 0.3s; }
.bounce-title span:nth-child(5) { animation-delay: 0.4s; }
.bounce-title span:nth-child(6) { animation-delay: 0.5s; }
.bounce-title span:nth-child(7) { animation-delay: 0.6s; }
.bounce-title span:nth-child(8) { animation-delay: 0.7s; }
.bounce-title span:nth-child(9) { animation-delay: 0.8s; }
.bounce-title span:nth-child(10) { animation-delay: 0.9s; }


@keyframes bounce {
  100% {
    top: -15px;
    text-shadow: 0 1px 0 #ccc,
                 0 2px 0 #ccc,
                 0 3px 0 #ccc,
                 0 4px 0 #ccc;
  }
}

@media (max-width: 768px) {
  .maine1 {
    flex-direction: column;
    text-align: center;
  }

  .left, .right {
    width: 100%;
    margin-bottom: 30px;
  }

  .right img {
    width: 250px;
    height: 250px;
  }
}

     </style>
</head>
<body>
  <header>
    <div class="logo_hopecart">
      <h1 class="logo">hope cart</h1>
    </div>
    <div class="buttons">
      <button onclick="location.href='./pages/login/index.php'">Se Connecter</button>
      <button onclick="location.href='pages/request_account.php'">Demande un compte</button>
    </div>
  </header>
    <div class="maine1">
        <div class="left">
<h1 class="bounce-title">
  <span>B</span>
  <span>i</span>
  <span>e</span>
  <span>n</span>
  <span>v</span>
  <span>e</span>
  <span>n</span>
  <span>u</span>
  <span>e</span>
  <span>!</span>

</h1>
            <p>Sur notre plateforme numérique avancée qui établit une connexion innovante et sécurisée entre les médecins et les patients, afin de garantir les meilleurs soins possibles à vos patients.</p>
        </div>
        <div class="right">
            <img src="./img/pexels-rethaferguson-3825529.jpg" alt="">

        </div>
    </div>
    <div class="maine2">
    <div class="container">
        <div class="section">
            <img src="./img/pexels-thirdman-5327579.jpg" alt="">
            <h2>Connexion numérique directe entre le médecin et le patient</h2>
            <p>
                Grâce à un identifiant unique (UID), le patient est automatiquement relié à son médecin, 
                permettant un accès rapide et sécurisé aux informations médicales, sans papiers ni complications.
            </p>
        </div>

        <div class="section">
        <img src="./img/USB-RFID.webp" alt="">

      <h2>Le dispositif Windows RFID est le cœur du système</h2>
      <p>
      La plateforme repose sur le dispositif Windows RFID, qui lit instantanément <br>la carte du patient et donne un accès immédiat à son dossier médical,<br> rendant le diagnostic et le traitement plus intelligents et fluides.
      </p>
      
    <a href="pages/request_account.php" class="cta-button"> Demande un compte</a>
    </div>

  </div>
    </div>
    </div>

    <footer class="footer">
  <i class="fas fa-balance-scale"></i> &copy; 2025 Tous droits réservés.
</footer>


</body>
</html>
