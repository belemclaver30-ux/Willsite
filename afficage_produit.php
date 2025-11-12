<?php
// Démarre la session
session_start();

// Inclure le fichier de connexion à la base de données
include(realpath(__DIR__ . '\\fonctions\db_connection.php'));

// Vérifier si une catégorie est passée en paramètre
$category_id = isset($_GET['categorie']) ? (int)$_GET['categorie'] : null;

// Préparer une variable pour le nom de la catégorie (par défaut "Tous les produits")
$category_name = "Tous les produits";

// Requête SQL pour récupérer les produits par catégorie
if ($category_id) {
	// Obtenir le nom de la catégorie
	$category_query = $conn->prepare("SELECT name FROM categories WHERE category_id = :category_id");
	$category_query->bindValue(':category_id', $category_id, PDO::PARAM_INT);
	$category_query->execute();
	$category = $category_query->fetch(PDO::FETCH_ASSOC);

	// Si la catégorie existe, modifier le titre
	if ($category) {
		$category_name = $category['name'];
	}

	// Récupérer les produits de la catégorie
	$sql = "SELECT * FROM products WHERE category_id = :category_id";
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
} else {
	// Afficher tous les produits si aucune catégorie n'est sélectionnée
	$sql = "SELECT * FROM products";
	$stmt = $conn->prepare($sql);
}

// Exécuter la requête
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<?php
include("./gestionDusite/components/head.php");
?>

<body class="animsition" style="margin-top: 50px;">


	<?php
	$page_active = 'boutique';
	include('./gestionDusite/components/navbar.php');
	?>

	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					<?= htmlspecialchars($category_name); ?>
				</h3>
			</div>

			<div class="row isotope-grid">
				<?php if (!empty($products)) : ?>
					<?php foreach ($products as $product) : ?>
						<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
							<div class="block2">
								<div class="block2-pic hov-img0">
									<img src="assets/img/uploads/<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>"
									style=" width: 300px;height:200px;object-fit: cover; ">
									<a href="product-detail.php?product_id=<?= htmlspecialchars($product['product_id']); ?>"
										class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
										Détails
									</a>
								</div>
								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l ">
										<a href="product-detail.php?id=<?= htmlspecialchars($product['product_id']); ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
											<?= htmlspecialchars($product['name']) ?>
										</a>
										<span class="stext-105 cl3">
											<?= number_format($product['prix'], 0, ',', ' ') ?> FCFA
										</span>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					<p>Aucun produit trouvé dans cette catégorie.</p>
				<?php endif; ?>
			</div>
		</div>

	</section>

	<?php
	include("./gestionDusite/components/footer.php");
	?>

</body>

</html>