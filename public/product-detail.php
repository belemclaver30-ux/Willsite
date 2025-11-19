<?php
/**
 * Page de détails d'un produit - Willsite
 */

// Inclure la configuration
require_once __DIR__ . '/../config/config.php';

// Vérifier si 'product_id' est passé dans l'URL
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    redirect(url('public/afficage_produit.php'));
    exit();
}

$product_id = (int)$_GET['product_id'];

// Requête pour récupérer le produit avec sa catégorie
$product_query = "SELECT p.*, c.name AS category_name 
                  FROM products p 
                  LEFT JOIN categories c ON p.category_id = c.category_id 
                  WHERE p.product_id = ?";
$product_result = $conn->prepare($product_query);
$product_result->execute([$product_id]);
$product = $product_result->fetch(PDO::FETCH_ASSOC);

// Si aucun produit trouvé, rediriger
if (!$product) {
    redirect(url('public/afficage_produit.php'));
    exit();
}

// Récupérer des produits similaires (même catégorie)
$similar_query = "SELECT * FROM products 
                  WHERE category_id = ? AND product_id != ? 
                  LIMIT 4";
$similar_result = $conn->prepare($similar_query);
$similar_result->execute([$product['category_id'], $product_id]);
$similar_products = $similar_result->fetchAll(PDO::FETCH_ASSOC);

// Variables pour la page
$pageTitle = escape($product['name']) . ' - Willsite';
$page_active = 'boutique';
?>
<!DOCTYPE html>
<html lang="fr">
<?php include APP_PATH . '/views/includes/head.php'; ?>

<body class="animsition">
    <?php include APP_PATH . '/views/includes/navbar.php'; ?>

    <!-- Breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-t-30 p-lr-0-lg">
            <a href="<?= url('public/index.php') ?>" class="stext-109 cl8 hov-cl1 trans-04">
                Accueil
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <a href="<?= url('public/afficage_produit.php?categorie=' . $product['category_id']) ?>" class="stext-109 cl8 hov-cl1 trans-04">
                <?= escape($product['category_name']) ?>
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                <?= escape($product['name']) ?>
            </span>
        </div>
    </div>

    <!-- Product Detail -->
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
                                    if (!empty($product[$field])) {
                                        $imagePath = escape($product[$field]);
                                        echo "
                                        <div class='item-slick3' data-thumb='" . asset('img/uploads/' . $imagePath) . "'>
                                            <div class='wrap-pic-w pos-relative'>
                                                <img src='" . asset('img/uploads/' . $imagePath) . "' alt='IMG-PRODUCT'>
                                                <a class='flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04' href='" . asset('img/uploads/' . $imagePath) . "'>
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
                        <h4 class='mtext-105 cl2 js-name-detail p-b-14'>
                            <?= escape($product['name']) ?>
                        </h4>

                        <span class='mtext-106 cl2'>
                            <?= formatPrice($product['prix']) ?>
                        </span>

                        <p class="stext-102 cl3 p-t-23">
                            <?= isset($product['description']) ? escape($product['description']) : 'Description non disponible.' ?>
                        </p>

                        <div class="p-t-33 p-b-60">
                            <div class="product-details">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Caractéristique</th>
                                            <th>Détails</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($product['processeur'])): ?>
                                        <tr>
                                            <th>Processeur</th>
                                            <td><?= escape($product['processeur']) ?></td>
                                        </tr>
                                        <?php endif; ?>
                                        
                                        <?php if (!empty($product['ram'])): ?>
                                        <tr>
                                            <th>RAM</th>
                                            <td><?= escape($product['ram']) ?></td>
                                        </tr>
                                        <?php endif; ?>
                                        
                                        <?php if (!empty($product['stockage'])): ?>
                                        <tr>
                                            <th>Stockage</th>
                                            <td><?= escape($product['stockage']) ?></td>
                                        </tr>
                                        <?php endif; ?>
                                        
                                        <?php if (!empty($product['ecran'])): ?>
                                        <tr>
                                            <th>Écran</th>
                                            <td><?= escape($product['ecran']) ?></td>
                                        </tr>
                                        <?php endif; ?>

                                        <tr>
                                            <th>Catégorie</th>
                                            <td>
                                                <a href="<?= url('public/afficage_produit.php?categorie=' . $product['category_id']) ?>">
                                                    <?= escape($product['category_name']) ?>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?php
                        $nomProduit = rawurlencode($product['name']);
                        $prixProduit = $product['prix'];
                        $messageFinal = "Bonjour, je suis intéressé par le produit : $nomProduit au prix de " . formatPrice($prixProduit);
                        $whatsappNumber = "22664282575"; // Remplacer par votre numéro
                        ?>

                        <div class="flex-w flex-r-m p-b-10">
                            <a class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                               href="https://wa.me/<?= $whatsappNumber ?>?text=<?= urlencode($messageFinal) ?>"
                               target="_blank" 
                               style="color: white; text-decoration: none;">
                                <i class="fa fa-whatsapp m-r-10"></i>
                                Commander sur WhatsApp
                            </a>
                        </div>

                        <div class="flex-w flex-m p-t-10">
                            <div class="size-204 flex-w flex-m respon6-next">
                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>

                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produits similaires -->
            <?php if (!empty($similar_products)): ?>
            <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
                <span class="stext-107 cl6 p-lr-25">
                    Catégories: <?= escape($product['category_name']) ?>
                </span>
            </div>

            <section class="sec-relate-product bg0 p-t-45 p-b-105">
                <div class="container">
                    <div class="p-b-45">
                        <h3 class="ltext-106 cl5 txt-center">
                            Produits similaires
                        </h3>
                    </div>

                    <div class="wrap-slick2">
                        <div class="slick2">
                            <?php foreach ($similar_products as $similar): ?>
                                <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                    <div class="block2">
                                        <div class="block2-pic hov-img0">
                                            <img src="<?= asset('img/uploads/' . $similar['image_url']) ?>" 
                                                 alt="<?= escape($similar['name']) ?>"
                                                 style="width: 270px; height: 180px; object-fit: cover;">
                                            <a href="<?= url('public/product-detail.php?product_id=' . $similar['product_id']) ?>" 
                                               class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                                Voir détails
                                            </a>
                                        </div>

                                        <div class="block2-txt flex-w flex-t p-t-14">
                                            <div class="block2-txt-child1 flex-col-l">
                                                <a href="<?= url('public/product-detail.php?product_id=' . $similar['product_id']) ?>" 
                                                   class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                    <?= escape($similar['name']) ?>
                                                </a>
                                                <span class="stext-105 cl3">
                                                    <?= formatPrice($similar['prix']) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php endif; ?>
        </div>
    </section>

    <?php include APP_PATH . '/views/includes/footer.php'; ?>
</body>
</html>
