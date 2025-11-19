<?php
// Récupérer les catégories pour le footer
$sql = "SELECT * FROM categories LIMIT 5";
$stmt = $conn->prepare($sql);
$stmt->execute();
$footer_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Catégories
                </h4>

                <ul>
                    <?php foreach ($footer_categories as $category): ?>
                        <li class="p-b-10">
                            <a href="<?= url('public/afficage_produit.php?categorie=' . $category['category_id']) ?>" class="stext-107 cl7 hov-cl1 trans-04">
                                <?= escape($category['name']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Services
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Maintenance
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Installation de logiciels
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Réparation
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Conseil et assistance
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Liens rapides
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="<?= url('public/index.php') ?>" class="stext-107 cl7 hov-cl1 trans-04">
                            Accueil
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="<?= url('public/about.php') ?>" class="stext-107 cl7 hov-cl1 trans-04">
                            À propos
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="<?= url('public/contact.php') ?>" class="stext-107 cl7 hov-cl1 trans-04">
                            Contact
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Livraison et retours
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Newsletter
                </h4>

                <p class="stext-107 cl7 size-201">
                    Inscrivez-vous pour recevoir nos dernières offres et nouveautés
                </p>

                <form>
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
                        <div class="focus-input1 trans-04"></div>
                    </div>

                    <div class="p-t-18">
                        <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                            S'inscrire
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-t-40">
            <div class="flex-c-m flex-w p-b-18">
                <a href="#" class="m-all-1">
                    <img src="<?= asset('img/images/icons/icon-pay-01.png') ?>" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="<?= asset('img/images/icons/icon-pay-02.png') ?>" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="<?= asset('img/images/icons/icon-pay-03.png') ?>" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="<?= asset('img/images/icons/icon-pay-04.png') ?>" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="<?= asset('img/images/icons/icon-pay-05.png') ?>" alt="ICON-PAY">
                </a>
            </div>

            <p class="stext-107 cl6 txt-center">
                Copyright &copy; <?= date('Y') ?> Tous droits réservés | 
                <a href="<?= url('public/index.php') ?>" class="cl8 hov-cl1">Willsite</a>
            </p>
        </div>
    </div>
</footer>

<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>

<!--===============================================================================================-->
<script src="<?= url('public/vendor/jquery/jquery-3.2.1.min.js') ?>"></script>
<!--===============================================================================================-->
<script src="<?= url('public/vendor/animsition/js/animsition.min.js') ?>"></script>
<!--===============================================================================================-->
<script src="<?= url('public/vendor/bootstrap/js/popper.js') ?>"></script>
<script src="<?= url('public/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
<!--===============================================================================================-->
<script src="<?= url('public/vendor/select2/select2.min.js') ?>"></script>
<!--===============================================================================================-->
<script src="<?= url('public/vendor/daterangepicker/moment.min.js') ?>"></script>
<script src="<?= url('public/vendor/daterangepicker/daterangepicker.js') ?>"></script>
<!--===============================================================================================-->
<script src="<?= url('public/vendor/slick/slick.min.js') ?>"></script>
<script src="<?= asset('js/slick-custom.js') ?>"></script>
<!--===============================================================================================-->
<script src="<?= url('public/vendor/parallax100/parallax100.js') ?>"></script>
<!--===============================================================================================-->
<script src="<?= url('public/vendor/MagnificPopup/jquery.magnific-popup.min.js') ?>"></script>
<!--===============================================================================================-->
<script src="<?= url('public/vendor/isotope/isotope.pkgd.min.js') ?>"></script>
<!--===============================================================================================-->
<script src="<?= url('public/vendor/sweetalert/sweetalert.min.js') ?>"></script>
<!--===============================================================================================-->
<script src="<?= url('public/vendor/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
<!--===============================================================================================-->
<script src="<?= asset('js/main.js') ?>"></script>

<script>
    $('.js-addwish-b2').on('click', function(e){
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function(){
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function(){
            swal(nameProduct, "a été ajouté à votre liste de souhaits !", "success");

            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });

    $('.js-addwish-detail').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

        $(this).on('click', function(){
            swal(nameProduct, "a été ajouté à votre liste de souhaits !", "success");

            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });

    $('.js-addcart-detail').each(function(){
        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function(){
            swal(nameProduct, "a été ajouté au panier !", "success");
        });
    });

    $('.js-pscroll').each(function(){
        $(this).css('position','relative');
        $(this).css('overflow','hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function(){
            ps.update();
        })
    });
</script>
