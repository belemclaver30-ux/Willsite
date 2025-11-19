<?php
/**
 * Page d'accueil - Willsite Boutique Informatique
 */

// Inclure la configuration
require_once __DIR__ . '/../config/config.php';

// Variables pour la page
$pageTitle = 'Accueil - Willsite Boutique Informatique';
$page_active = 'index';

// Récupérer les produits
$sql = "SELECT p.*, c.name AS category_name
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.category_id
        LIMIT 12";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<?php include APP_PATH . '/views/includes/head.php'; ?>

<body class="animsition">
    <?php include APP_PATH . '/views/includes/navbar.php'; ?>

    <!-- Slider -->
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                <div class="item-slick1" style="background-image: url(<?= asset('img/images/SLIDE4.jpg') ?>); width: 1920px; height: 930px;">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    Ordinateur portable
                                </span>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                <h2 class="ltext-201 cl10 p-t-19 p-b-43 respon1">
                                    ThinkPad & Lenovo FRANCE
                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                <a href="<?= url('public/afficage_produit.php') ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    ACHETER MAINTENANT
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-slick1" style="background-image: url(<?= asset('img/images/SLIDE13.jpg') ?>); width: 1920px; height: 800px;">
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
                                <a href="<?= url('public/afficage_produit.php') ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    ACHETER MAINTENANT
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-slick1" style="background-image: url(<?= asset('img/images/SLIDE5.jpg') ?>); width: 1920px; height: 930px;">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    Accessoires
                                </span>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                <h2 class="ltext-201 cl10 p-t-19 p-b-43 respon1">
                                    Pour un confort total
                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
                                <a href="<?= url('public/afficage_produit.php') ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    ACHETER MAINTENANT
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Banner -->
    <div class="sec-banner bg0 p-t-80 p-b-50">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <div class="block1 wrap-pic-w">
                        <img src="<?= asset('img/images/banner-01.jpg') ?>" alt="IMG-BANNER">
                        <a href="<?= url('public/afficage_produit.php') ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Ordinateurs
                                </span>
                                <span class="block1-info stext-102 trans-04">
                                    Nouvelle collection
                                </span>
                            </div>
                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Acheter maintenant
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <div class="block1 wrap-pic-w">
                        <img src="<?= asset('img/images/banner-02.jpg') ?>" alt="IMG-BANNER">
                        <a href="<?= url('public/afficage_produit.php') ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Accessoires
                                </span>
                                <span class="block1-info stext-102 trans-04">
                                    Nouveautés 2025
                                </span>
                            </div>
                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Acheter maintenant
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <div class="block1 wrap-pic-w">
                        <img src="<?= asset('img/images/banner-03.jpg') ?>" alt="IMG-BANNER">
                        <a href="<?= url('public/afficage_produit.php') ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Batteries
                                </span>
                                <span class="block1-info stext-102 trans-04">
                                    Longue durée
                                </span>
                            </div>
                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Acheter maintenant
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                </div>
            </div>

            <div class="row isotope-grid">
                <?php foreach ($products as $product): ?>
                    <?php
                    $category_class = isset($product["category_name"]) ? preg_replace('/[^a-zA-Z0-9]/', '', $product["category_name"]) : "Autre";
                    ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?= escape($category_class); ?>">
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="<?= asset('img/uploads/' . $product['image_url']) ?>" 
                                     alt="<?= escape($product['name']) ?>"
                                     style="width: 300px; height: 200px; object-fit: cover;">
                                <a href="<?= url('public/product-detail.php?product_id=' . $product['product_id']) ?>" 
                                   class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                    Détails
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l">
                                    <a href="<?= url('public/product-detail.php?product_id=' . $product['product_id']) ?>" 
                                       class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        <?= escape($product['name']); ?>
                                    </a>

                                    <span class="stext-105 cl3">
                                        <?= formatPrice($product['prix']); ?>
                                    </span>

                                    <span class="badge badge-info mt-1">
                                        <?= escape($product['category_name'] ?? 'Autre'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php include APP_PATH . '/views/includes/footer.php'; ?>
</body>
</html>
