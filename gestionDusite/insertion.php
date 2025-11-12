<?php

include(realpath('') ."\\fonctions\db_connection.php");
include('function/fichier.php');

if (isset($_POST['enregistrer'])) {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];
    $image_url  = uploadImageFile('image_url');

    if (!empty($name) && !empty($description) && !empty($prix) && !empty($image_url)) {


        try {
            $request = $conn->prepare('INSERT INTO products(name,description,prix,image_url,category_id) VALUES (:name,:description,:prix,:image_url,:category_id)');

            // Liaison des paramètres
            $request->bindValue(':name', $name, PDO::PARAM_STR); // Liaison de la valeur de $name
            $request->bindValue(':description', $description, PDO::PARAM_STR); // Liaison de la valeur de $description
            $request->bindValue(':prix', $prix, PDO::PARAM_INT); // Liaison de la valeur de $prix
            $request->bindValue(':category_id', $categorie, PDO::PARAM_INT); // Liaison de la valeur de $prix
            $request->bindValue(':image_url',  $image_url, PDO::PARAM_STR); // Liaison de la valeur de $image_url

            // Exécution de la requête
            if ($request->execute()) {
                echo "Produit ajouté avec succès !";
            } else {
                echo "Erreur lors de l'ajout du produit.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "tout les champs sont requis!";
    }
}




// Inclure le fichier de connexion à la base de données

// Requête SQL pour récupérer les produits
$sql = "SELECT * FROM categories"; // Adaptez cette requête à votre structure de base de données
$stmt = $conn->prepare($sql); // Préparer la requête
$stmt->execute(); // Exécuter la requête

// Récupérer tous les résultats sous forme de tableau associatif
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gestion des informations</title>
    <link rel="stylesheet" href="./gestion_style.css">
</head>

<body>
    <form action="insertion.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend><b>Vos informations</b></legend>
            <table>

                <tr>
                    <td>Nom:</td>
                    <td><input type="text" name="name" size="50" maxlength="50"></td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td><input type="text" name="description" size="50" maxlength="50"></td>
                </tr>

                <tr>
                    <td>Prix</td>
                    <td><input type="number" name="prix" size="50" maxlength="50"></td>
                </tr>

                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="image_url" size="50" maxlength="50"></td>
                </tr>

                <tr>
                    <td>Categorie:</td>
                    <td>
                        <select name="categorie" id="categorie">
                            <?php foreach ($categories as $categorie): ?>
                                <option value="<?= htmlspecialchars($categorie['category_id']); ?>"><?= htmlspecialchars($categorie['name']); ?></option>


                            <?php endforeach;

                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <!-- <td class="reset-button"><input type="reset" name="Effacer" value="Effacer"></td> -->
                    <td class="submit-button"><input type="submit" name="enregistrer" value="Enregistrer"></td>

                </tr>

            </table>
        </fieldset>
    </form>
</body>

</html>