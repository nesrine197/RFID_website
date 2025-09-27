<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page de demande</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f2f6fa;
    color: #333;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
    margin: 0;
  padding: 0;
  position: relative;
}


body::before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('./img/pexels-shvetsa-4483327.jpg'); 
  background-size: cover;
  background-position: center;
  filter: blur(5px);
  z-index: -1;
}
/* تصميم القسم */
#joinRequestSection {
    background-color: #ffffff;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 30px;
    width: 100%;
    max-width: 500px;
    text-align: center;
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

h3 {
    font-size: 24px;
    color: #2a7f64;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-size: 16px;
    color: #555;
    margin-bottom: 5px;
    text-align: left;
}

input[type="text"],
input[type="email"] {
    padding: 12px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
    color: #555;
    background-color: #f9f9f9;
    margin-bottom: 10px;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
input[type="email"]:focus {
    border-color: #2a7f64;
    outline: none;
}

/* زر الإرسال */
button {
    background-color: #2a7f64;
    color: white;
    font-size: 16px;
    padding: 12px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #1e674f;
}

@media print {
    body {
        padding: 0;
        height: auto;
    }

    #joinRequestSection {
        box-shadow: none;
        border-radius: 0;
    }

    button {
        display: none;
    }
}

    </style>
</head>
<body>
<div id="joinRequestSection" class="hidden">
    <h3>Envoyer une demande d'adhésion</h3>
    <form method="POST" action="ajouter_demande.php">
        <div class="form-group">
            <label>Prénom</label>
            <input type="text" name="first_name" required>
        </div>
        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="last_name" required>
        </div>
        <div class="form-group">
            <label>Wilaya</label>
            <input type="text" name="state" required>
        </div>
        <div class="form-group">
            <label>Daïra</label>
            <input type="text" name="district" required>
        </div>
        <div class="form-group">
            <label>Commune</label>
            <input type="text" name="municipality" required>
        </div>
        <div class="form-group">
            <label>Spécialité</label>
            <input type="text" name="specialization" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <button type="submit">Envoyer la demande</button>
    </form>
</div>
 
</body>

</html>
