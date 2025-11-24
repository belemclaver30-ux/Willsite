<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Categories
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Ordinateur portable
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Batteries
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Accessoirs
                        </a>
                    </li>
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
                            Formation en informatique
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Mise à Niveau et Optimisation
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    CONTACTEZ-NOUS
                </h4>

                <p class="stext-107 cl7 size-201">
                    Vous avez des questions ? N'hésitez pas à nous contacter en boutique à kalgodin, en face de la station Petrofa ou appelez-nous au (+226) 64282575.
                </p>
            </div>
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
<script src="<?= BASE_URL ?>/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?= BASE_URL ?>/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="<?= BASE_URL ?>/vendor/bootstrap/js/popper.js"></script>
<script src="<?= BASE_URL ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?= BASE_URL ?>/vendor/select2/select2.min.js"></script>
<script>
    $(".js-select2").each(function() {
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    })
</script>
<!--===============================================================================================-->
<script src="<?= BASE_URL ?>/vendor/daterangepicker/moment.min.js"></script>
<script src="<?= BASE_URL ?>/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="<?= BASE_URL ?>/vendor/slick/slick.min.js"></script>
<script src="<?= BASE_URL ?>/assets/js/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="<?= BASE_URL ?>/vendor/parallax100/parallax100.js"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="<?= BASE_URL ?>/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script>
    $('.gallery-lb').each(function() {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled: true
            },
            mainClass: 'mfp-fade'
        });
    });
</script>
<!--===============================================================================================-->
<script src="<?= BASE_URL ?>/vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="<?= BASE_URL ?>/vendor/sweetalert/sweetalert.min.js"></script>
<script>
    $('.js-addwish-b2').on('click', function(e) {
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function() {
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist !", "success");
            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });

    $('.js-addwish-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist !", "success");
            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });

    $('.js-addcart-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to cart !", "success");
        });
    });
</script>
<!--===============================================================================================-->
<script src="<?= BASE_URL ?>/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script>
    $('.js-pscroll').each(function() {
        $(this).css('position', 'relative');
        $(this).css('overflow', 'hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function() {
            ps.update();
        })
    });
</script>
<!--===============================================================================================-->
<script src="<?= BASE_URL ?>/assets/js/main.js"></script>
