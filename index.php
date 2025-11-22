<?php

// Inclure la configuration centralisée (la session est démarrée automatiquement)
require_once __DIR__ . '/config/config.php';

// Connexion à la base de données
$conn = getDbConnection();

// Requête SQL pour récupérer les produits
$sql = "SELECT * FROM products order by product_id DESC LIMIT 10"; // Adaptez cette requête à votre structure de base de données
$stmt = $conn->prepare($sql); // Préparer la requête
$stmt->execute(); // Exécuter la requête

// Récupérer tous les résultats sous forme de tableau associatif
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = $conn->query("
  SELECT p.*, c.name AS category_name
  FROM products p
  LEFT JOIN categories c ON p.category_id = c.category_id 
  order by p.product_id DESC
");
$products = $query->fetchAll(PDO::FETCH_ASSOC);





?>



<!DOCTYPE html>
<html lang="en">

<body class="animsition">
	<?php
	include __DIR__ . '/app/views/includes/head.php';
	?>

	<script>
		// function submitForm(categoryId, categorieName, actionUrl) {
		// 	$_SESSION['category_id'] =categoryId;
		// 	$_SESSION['category_name'] =categorieName;
		// 	$_SESSION['action_url'] =actionUrl;

		// 	header("Location: ". $actionUrl);
		// 	exit();
		// }


		function submitForm(categoryId, categorieName, actionUrl) {
			// Crée un formulaire dynamique avec la valeur appropriée de category_id
			var form = document.createElement("form");
			form.method = "POST";
			form.action = actionUrl;

			// Crée un champ caché pour category_id
			var input = document.createElement("input");
			input.type = "hidden";
			input.name = "category_id";
			input.value = categoryId;


			// Crée un champ caché pour categorieName
			var input_name = document.createElement("input");
			input_name.type = "hidden";
			input_name.name = "category_name";
			input_name.value = categorieName;

			form.appendChild(input);
			form.appendChild(input_name);

			// Soumet le formulaire
			document.body.appendChild(form);
			form.submit();
		}
	</script>


	<?php
	$page_active = 'index';
	include __DIR__ . '/app/views/includes/navbar.php';
	?>


	<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1"
					style="background-image: url(assets/img/images/SLIDE4.jpg);width: 1920px; height: 930px;">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Ordinateur portable
								</span>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl10 p-t-19 p-b-43 respon1 ">
									ThinkPad & Lenovo FRANCE
								</h2>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="<?= url('afficage_produit.php') ?>"
									class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									ACHETER MAINTENANT
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1"
					style="background-image: url(assets/img/images/SLIDE13.jpg);width: 1920px; height: 800px;">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									BATTERIES
								</span>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl10 p-t-19 p-b-43 respon1">
									Performantes avec une bonne autonomie
								</h2>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="<?= url('afficage_produit.php') ?>"
									class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									ACHETER MAINTENANT
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1"
					style="background-image: url(assets/img/images/SLIDE5.jpg);width: 1920px; height: 930px;">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Accessoirs
								</span>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl10 p-t-19 p-b-43 respon1">
									Pour un confort total
								</h2>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
								<a href="<?= url('afficage_produit.php') ?>"
									class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									ACHETER MAINTENANT
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	include __DIR__ . '/app/views/includes/banner.php';
	?>


	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Aperçu des produits
				</h3>
			</div>


			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						TOUS les produits
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".Ordinateurs">
						Ordinateurs portables
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".Batteries">
						batteries
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".USB">
						Clés USB
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".Accessoires">
						Accessoirs
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".Chargeur">
						Chargeurs
					</button>
				</div>

			</div>


			<div class="row isotope-grid">

				<?php foreach ($products as $product): ?>
					<?php
					// Utiliser le nom de la catégorie comme classe CSS
					$category_class = isset($product["category_name"]) ? preg_replace('/[^a-zA-Z0-9]/', '', $product["category_name"]) : "Autre";
					?>

					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?= htmlspecialchars($category_class); ?>">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="<?= asset('img/uploads/' . htmlspecialchars($product['image_url'])) ?>"
									alt="<?= htmlspecialchars($product['name']) ?>"
									style=" width: 300px;height:200px;object-fit: cover; ">
								<a href="<?= url('product-detail.php?product_id=' . htmlspecialchars($product['product_id'])) ?>"
									class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
									Details
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l">
									<a href="#" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										<?= htmlspecialchars($product['name']); ?>
									</a>

									<span class="stext-105 cl3">
										<?= htmlspecialchars($product['prix']); ?> FCFA
									</span>

									<!-- Affichage de la catégorie -->
									<span class="badge badge-info mt-1">
										<?= htmlspecialchars($product['category_name'] ?? 'Autre'); ?>
									</span>
								</div>

								<!-- <div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
											alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l"
											src="images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div> -->
							</div>
						</div>
					</div>

				<?php endforeach;
				session_unset(); ?>

			</div>



	</section>


	<?php
	include __DIR__ . '/app/views/includes/footer.php';
	?>


</body>

</html>