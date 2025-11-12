<?php
include(realpath(__DIR__ . '\\fonctions\db_connection.php'));
?>



<!DOCTYPE html>
<html lang="en">

<body class="animsition">
	<?php
	include("./gestionDusite/components/head.php");
	?>

	<!-- Header -->
	<?php
	$page_active = 'about';
	include('./gestionDusite/components/navbar.php');
	?>


	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('assets/img/images/apropo.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			A propos
		</h2>
	</section>


	<!-- Content page -->
	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
			<div class="row p-b-148">
				<div class="col-md-7 col-lg-8">
					<div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
						<h3 class="mtext-111 cl2 p-b-16">
							À propos de WILL SERVICES INFORMATIQUES
						</h3>

						<p class="stext-113 cl6 p-b-26">
							Bienvenue chez WILL SERVICES INFORMATIQUES ! Nous sommes une équipe passionnée par la technologie et dédiée à vous aider à trouver les meilleures solutions informatiques. Que vous cherchiez un ordinateur portable performant, une batterie fiable ou des accessoires pratiques, nous avons ce qu'il vous faut.

							Nous comprenons que choisir le bon équipement peut parfois être un défi. C'est pourquoi notre équipe est toujours là pour vous conseiller et vous guider. Nous sélectionnons avec soin nos produits pour garantir leur qualité et leur performance, afin que vous puissiez profiter pleinement de votre expérience numérique..
						</p>

						<p class="stext-113 cl6 p-b-26">
							Chez WILL SERVICES INFORMATIQUES, notre priorité est de vous offrir un service client chaleureux et attentif. Nous sommes là pour répondre à vos questions et vous apporter le soutien dont vous avez besoin.

							Rejoignez notre famille de clients satisfaits et découvrons ensemble comment la technologie peut simplifier votre vie. Nous avons hâte de vous accompagner dans votre parcours numérique !
						</p>
					</div>
				</div>

				<div class="col-11 col-md-5 col-lg-4 m-lr-auto">
					<div class="how-bor1 ">
						<div class="hov-img0">
							<img src="assets/img/images/photo site/new/pas.jpg" alt="IMG">
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="order-md-2 col-md-7 col-lg-8 p-b-30">
					<div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
						<h3 class="mtext-111 cl2 p-b-16">
							Notre Mission
						</h3>

						<p class="stext-113 cl6 p-b-26">
							Chez WILL SERVICES INFORMATIQUES, notre mission est simple : rendre la technologie accessible et agréable pour tous. Nous nous engageons à offrir des produits informatiques de qualité, adaptés aux besoins de chacun, que ce soit pour le travail, les études ou les loisirs.

							Nous croyons que chaque client mérite une expérience personnalisée. C'est pourquoi nous nous efforçons de comprendre vos besoins spécifiques et de vous fournir des conseils honnêtes et transparents. Notre objectif est de vous aider à faire le meilleur choix en matière de matériel informatique, tout en garantissant un service client exemplaire.

							Nous sommes également déterminés à rester à la pointe de l’innovation, en vous proposant les dernières tendances et technologies. Ainsi, nous vous aidons à rester compétitif dans un monde numérique en constante évolution.
						</p>

						<div class="bor16 p-l-29 p-b-9 m-t-22">
							<p class="stext-114 cl6 p-r-40 p-b-11">
								En somme, notre mission est de vous accompagner dans votre aventure numérique, en vous fournissant les outils et le soutien nécessaires pour réussir.
							</p>

							<!-- <span class="stext-111 cl8">
								- Steve Job’s 
							</span> -->
						</div>
					</div>
				</div>

				<div class="order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
					<div class="how-bor2">
						<div class="hov-img0">
							<img src="assets/img/images/photo site/slide/jeune-homme-noir-aide-son-ordinateur-portable-gai-grand-sourire_1187-18888.avif" alt="IMG">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>



	<?php
	include("./gestionDusite/components/banner.php");
	?>


	<?php
	include("./gestionDusite/components/footer.php");
	?>


</body>

</html>