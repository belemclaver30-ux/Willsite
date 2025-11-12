<?php
include("../fonctions/db_connection.php");
?>
<!DOCTYPE html>
<html>


<?php
include( "../gestionDusite/components/head.php");
?>


<body>

	<?php
	include("../gestionDusite/components/navbar.php");
	?>





	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92"
		style="background-image: url('images/visage-humain-expressions-emotions-et-sentiments-beau-jeune-homme-afro-americain-regardant-avec-tho.jpg'); height: 35%;margin-top: 20px;">
		<h2 class="ltext-105 cl0 txt-center">
			ERREUR 404
		</h2>
	</section>


	<!-- Content page -->
	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
			<div class="row p-b-148">
				<div class="col-md-7 col-lg-8">
					<div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
						<h3 class="mtext-111 cl2 p-b-16">
							Oups! Page introuvable
						</h3>

						<p class="stext-113 cl6 p-b-26">
							Vous avez tenté d’accéder à une page qui ne se trouve plus sur ce site. Veuillez revenir sur
							la page d'accueil afin de continuer votre navigation sur notre site.</p>
					</div>
				</div>

				<!-- <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
					<div class="how-bor1 ">
						<div class="hov-img0">
							<img src="images/oops-erreur-404.avif" alt="IMG">
						</div>
					</div>
				</div> -->
			</div>

		</div>
	</section>
	<?php
	include("../gestionDusite/components/footer.php");
	?>

</body>

</html>