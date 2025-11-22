<?php
// Inclure la configuration
require_once __DIR__ . '/config/config.php';
$conn = getDbConnection();

// Vérifier si 'product_id' est passé dans l'URL
if (isset($_GET['product_id'])) {
	$product_get = $_GET['product_id'];
} else {
	die("Product ID is missing.");
}

// Requête sécurisée pour récupérer le produit
$product_query = "SELECT * FROM products WHERE product_id = ?";
$product_result = $conn->prepare($product_query);
$product_result->execute([$product_get]);
$product = $product_result->fetchAll(PDO::FETCH_ASSOC);

// Si aucun produit trouvé, stopper
if (empty($product)) {
	die("Produit non trouvé.");
}

// Prendre le premier produit pour l'affichage principal
$main_product = $product[0];


?>

<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/app/views/includes/head.php'; ?>

<body class="animsition">
	<?php include __DIR__ . '/app/views/includes/navbar.php'; ?>

	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row" style="margin-top:60px;">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
							<div class="slick3 gallery-lb">
								<?php
								// Colonnes d'images à afficher
								$image_fields = ['image_url', 'first_image', 'second_image', 'third_image'];

							foreach ($image_fields as $field) {
								if (!empty($main_product[$field])) {
									$imagePath = htmlspecialchars($main_product[$field]);
									$imageUrl = asset('img/uploads/' . $imagePath);
									echo "
									<div class='item-slick3' data-thumb='$imageUrl'>
										<div class='wrap-pic-w pos-relative'>
											<img src='$imageUrl' alt='IMG-PRODUCT'>
											<a class='flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04' href='$imageUrl'>
												<i class='fa fa-expand'></i>
											</a>
										</div>
									</div>";
								}
							}
								?>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class='mtext-105 cl2 js-name-detail pb-14'>
							<?= htmlspecialchars($main_product['name']) ?>
						</h4>

						<span class='mtext-106 cl2'>
							<?= htmlspecialchars($main_product['prix']) ?> FCFA
						</span>

						<div class="p-b-30">
							<div class="product-details">
								<table>
									<thead>
										<tr>
											<th>Caractéristique</th>
											<th>Détails</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th>Processeur</th>
											<td><?= htmlspecialchars($main_product['processeur']) ?></td>
										</tr>
										<tr>
											<th>Stockage</th>
											<td><?= htmlspecialchars($main_product['stockage']) ?></td>
										</tr>
										<tr>
											<th>Écran</th>
											<td><?= htmlspecialchars($main_product['ecran']) ?></td>
										</tr>
										<tr>
											<th>RAM</th>
											<td><?= htmlspecialchars($main_product['ram']) ?></td>
										</tr>
									</tbody>
								</table>
							</div>

							<?php
							$nomProduit = rawurlencode($main_product['name']);
							$prixProduit = $main_product['prix'];
							$messageFinal = "Hello, je suis intéressé par le produit : $nomProduit au prix de $prixProduit FCFA";
							?>
                           

						<a class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04"
							href="<?= url('fonctions/compter_clic.php?product_id=' . $main_product['product_id'] . '&text=' . urlencode($messageFinal)) ?>"
							target="_blank" style="color: white; text-decoration: none;">
							Ajouter
						</a>						</div> <!-- .p-b-30 -->
					</div> <!-- .p-r-50 -->
				</div>
			</div>
		</div>
	</section>

	<?php include __DIR__ . '/app/views/includes/banner.php'; ?>
	<?php include __DIR__ . '/app/views/includes/footer.php'; ?>
</body>

</html>