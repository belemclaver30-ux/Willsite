<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles.css"> <!-- lien vers le fichier CSS externe -->
    
</head>

<body>
    <div class="container">
        <div class="form-section">
            <div class="logo">
                <img src="..assets/img/images/photo site/new/logo.jpg" alt="IMG-LOGO" style="width: 100px;margin-left:150px;border-radius: 30px ">
            </div>
            <h2>Connexion</h2>
            <form action="connect_dash.php" method="POST">
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Se connecter <i class="fas fa-arrow-right"></i></button>
            </form>

            <div>
                <li>Si vous avez oublié votre mot de passe veillez contacter l'administrateur!!</li>
            </div>

        </div>
        <div class="visual-section"></div>
    </div>
</body>


</html>