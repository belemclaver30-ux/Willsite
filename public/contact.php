<?php
/**
 * Page Contact - Willsite Boutique Informatique
 */

// Inclure la configuration
require_once __DIR__ . '/../config/config.php';

// Variables pour la page
$pageTitle = 'Contact - Willsite';
$page_active = 'contact';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizeString(post('email'));
    $message = sanitizeString(post('msg'));
    
    if (empty($email) || empty($message)) {
        setFlashMessage('Veuillez remplir tous les champs.', 'error');
    } elseif (!isValidEmail($email)) {
        setFlashMessage('Veuillez entrer une adresse email valide.', 'error');
    } else {
        try {
            $sql = "INSERT INTO messages (email, message, created_at) VALUES (?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email, $message]);
            
            setFlashMessage('Votre message a été envoyé avec succès. Nous vous répondrons bientôt.', 'success');
            redirect(url('public/contact.php'));
        } catch (PDOException $e) {
            setFlashMessage('Une erreur est survenue. Veuillez réessayer.', 'error');
            if (APP_DEBUG) {
                logMessage('Erreur envoi message : ' . $e->getMessage(), 'error');
            }
        }
    }
}

$flashMessage = getFlashMessage();
$flashError = getFlashMessage('error');
?>
<!DOCTYPE html>
<html lang="fr">
<?php include APP_PATH . '/views/includes/head.php'; ?>

<body class="animsition">
    <?php include APP_PATH . '/views/includes/navbar.php'; ?>

    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('<?= asset('img/images/contactpt.jpg') ?>');">
        <h2 class="ltext-105 cl0 txt-center">
            Contact
        </h2>
    </section>

    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <?php if ($flashMessage): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= escape($flashMessage) ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if ($flashError): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= escape($flashError) ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="flex-w flex-tr">
                <div class="size-210 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <form action="<?= url('public/contact.php') ?>" method="POST">
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            Envoyez-nous un message
                        </h4>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" 
                                   type="email" 
                                   name="email" 
                                   placeholder="Votre Email" 
                                   required>
                            <img class="how-pos4 pointer-none" src="<?= asset('img/images/icons/icon-email.png') ?>" alt="ICON">
                        </div>

                        <div class="bor8 m-b-30">
                            <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" 
                                      name="msg" 
                                      placeholder="Comment pouvons-nous vous aider ?" 
                                      required></textarea>
                        </div>

                        <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
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
                                Kalgodin face à la station petrofa<br>
                                Ouagadougou, Burkina Faso
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-phone-handset"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Appelez-nous
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                +226 64 28 25 75
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
                                contact@willsite.bf
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include APP_PATH . '/views/includes/footer.php'; ?>
</body>
</html>
