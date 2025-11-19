<?php
/**
 * Page d'affichage des produits par catégorie - Willsite
 */

// Inclure la configuration
require_once __DIR__ . '/../config/config.php';

// Variables pour la page
$pageTitle = 'Nos Produits - Willsite';
$page_active = 'boutique';

// Vérifier si une catégorie est passée en paramètre
$category_id = isset($_GET['categorie']) ? (int)$_GET['categorie'] : null;

// Variable pour le nom de la catégorie
$category_name = "Tous les produits";

// Requête SQL pour récupérer les produits
if ($category_id) {
    // Obtenir le nom de la catégorie
    $category_query = $conn->prepare("SELECT name FROM categories WHERE category_id = ?");
    $category_query->execute([$category_id]);
    $category = $category_query->fetch(PDO::FETCH_ASSOC);

    // Si la catégorie existe, modifier le titre
    if ($category) {
        $category_name = $category['name'];
        $pageTitle = $category_name . ' - Willsite';
    }

    // Récupérer les produits de la catégorie
    $sql = "SELECT p.*, c.name AS category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.category_id 
            WHERE p.category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$category_id]);
} else {
    // Afficher tous les produits
    $sql = "SELECT p.*, c.name AS category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.category_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer toutes les catégories pour le filtre
$categories_sql = "SELECT * FROM categories ORDER BY name";
$categories_stmt = $conn->prepare($categories_sql);
$categories_stmt->execute();
$all_categories = $categories_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<?php include APP_PATH . '/views/includes/head.php'; ?>

<body class="animsition" style="margin-top: 50px;">
    <?php include APP_PATH . '/views/includes/navbar.php'; ?>

    <!-- Breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-t-30 p-lr-0-lg">
            <a href="<?= url('public/index.php') ?>" class="stext-109 cl8 hov-cl1 trans-04">
                Accueil
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                <?= escape($category_name) ?>
            </span>
        </div>
    </div>

    <!-- Product -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <h3 class="ltext-103 cl5">
                        <?= escape($category_name) ?>
                    </h3>
                </div>

                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Filtrer
                    </div>

                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Rechercher
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <form action="<?= url('public/afficage_produit.php') ?>" method="GET">
                        <div class="bor8 dis-flex p-l-15">
                            <button type="submit" class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                            <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" placeholder="Rechercher...">
                        </div>
                    </form>
                </div>

                <!-- Filter -->
                <div class="dis-none panel-filter w-full p-t-10">
                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Trier par
                            </div>
                            <ul>
                                <li class="p-b-6">
                                    <a href="<?= url('public/afficage_produit.php' . ($category_id ? '?categorie=' . $category_id . '&sort=default' : '?sort=default')) ?>" class="filter-link stext-106 trans-04">
                                        Par défaut
                                    </a>
                                </li>
                                <li class="p-b-6">
                                    <a href="<?= url('public/afficage_produit.php' . ($category_id ? '?categorie=' . $category_id . '&sort=price-asc' : '?sort=price-asc')) ?>" class="filter-link stext-106 trans-04">
                                        Prix: croissant
                                    </a>
                                </li>
                                <li class="p-b-6">
                                    <a href="<?= url('public/afficage_produit.php' . ($category_id ? '?categorie=' . $category_id . '&sort=price-desc' : '?sort=price-desc')) ?>" class="filter-link stext-106 trans-04">
                                        Prix: décroissant
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Catégories
                            </div>
                            <ul>
                                <li class="p-b-6">
                                    <a href="<?= url('public/afficage_produit.php') ?>" class="filter-link stext-106 trans-04 <?= !$category_id ? 'how-active1' : '' ?>">
                                        Toutes les catégories
                                    </a>
                                </li>
                                <?php foreach ($all_categories as $cat): ?>
                                    <li class="p-b-6">
                                        <a href="<?= url('public/afficage_produit.php?categorie=' . $cat['category_id']) ?>" 
                                           class="filter-link stext-106 trans-04 <?= $category_id == $cat['category_id'] ? 'how-active1' : '' ?>">
                                            <?= escape($cat['name']) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row isotope-grid">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
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
                                            <?= escape($product['name']) ?>
                                        </a>
                                        <span class="stext-105 cl3">
                                            <?= formatPrice($product['prix']) ?>
                                        </span>
                                        <?php if (isset($product['category_name'])): ?>
                                            <span class="badge badge-info mt-1">
                                                <?= escape($product['category_name']) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="text-center p-t-50 p-b-50">
                            <i class="zmdi zmdi-shopping-cart-plus" style="font-size: 100px; color: #ccc;"></i>
                            <h4 class="mtext-105 cl2 p-t-20">
                                Aucun produit trouvé
                            </h4>
                            <p class="stext-113 cl6 p-t-10">
                                Essayez de changer vos critères de recherche ou parcourez d'autres catégories.
                            </p>
                            <a href="<?= url('public/afficage_produit.php') ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 m-t-20" style="display: inline-flex;">
                                Voir tous les produits
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php include APP_PATH . '/views/includes/footer.php'; ?>
</body>
</html>
