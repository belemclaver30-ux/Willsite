<?php
require_once __DIR__ . '/config/config.php';
$conn = getDbConnection();
?>



<!DOCTYPE html>
<html lang="en">


<body class="animsition">
	<?php
	include __DIR__ . '/app/views/includes/head.php';
	?>
	<!-- Header -->
	<?php
	$page_active = 'contact';
	include __DIR__ . '/app/views/includes/navbar.php';
	?>


	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('assets/img/images/contactpt.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Contact
		</h2>
	</section>


	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<?php
			// Afficher les messages de succès
			if (isset($_SESSION['contact_success'])) {
				echo '<div class="alert alert-success" style="background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;">';
				echo '<strong>Succès !</strong> ' . htmlspecialchars($_SESSION['contact_success']);
				echo '</div>';
				unset($_SESSION['contact_success']);
			}

			// Afficher les messages d'erreur
			if (isset($_SESSION['contact_errors'])) {
				echo '<div class="alert alert-danger" style="background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 5px;">';
				echo '<strong>Erreur !</strong><ul style="margin: 10px 0 0 20px;">';
				foreach ($_SESSION['contact_errors'] as $error) {
					echo '<li>' . htmlspecialchars($error) . '</li>';
				}
				echo '</ul></div>';
				unset($_SESSION['contact_errors']);
			}

			// Récupérer les anciennes valeurs en cas d'erreur
			$old_email = $_SESSION['contact_old']['email'] ?? '';
			$old_msg = $_SESSION['contact_old']['msg'] ?? '';
			unset($_SESSION['contact_old']);
			?>
			<div class="flex-w flex-tr">
				<div class="size-210 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form action="<?= url('fonctions/send_message.php') ?>" method="POST">

						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Envoyez nous un Message
						</h4>

					<div class="bor8 m-b-20 how-pos4-parent">
						<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email"
							placeholder="Votre Email" value="<?= htmlspecialchars($old_email) ?>" required>
						<i class="fa fa-envelope how-pos4 pointer-none" style="font-size: 18px; color: #999;"></i>
					</div>

					<div class="bor8 m-b-30">
						<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg"
							placeholder="Comment pouvons-nous vous aider ?" required><?= htmlspecialchars($old_msg) ?></textarea>
					</div>						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Envoyer
						</button>
					</form>
				</div>

				<div class="size-210 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Notre Adresse
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								Kalgodin face a la station petrofa
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Appeler Nous
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								+226 64282575
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Adresse mail
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								willserviceinformatique@gmail.com
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	include __DIR__ . '/app/views/includes/banner.php';
	?>



	<!-- Map -->
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Notre Localisation</div>
				</div>
				<div class="card-body">
					<iframe
						src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63536.63871717301!2d95.32870249999999!3d5.5611019!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3040377ae63dbcdf%3A0x3039d80b220cb90!2sBanda%20Aceh%2C%20Kota%20Banda%20Aceh%2C%20Aceh!5e0!3m2!1sid!2sid!4v1701054428265!5m2!1sid!2sid"
						width="600" height="450" style="border: 0; width: 100%" allowfullscreen="" loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
		</div>
	</div>
	<?php
	include __DIR__ . '/app/views/includes/footer.php';
	?>

</body>

</html>