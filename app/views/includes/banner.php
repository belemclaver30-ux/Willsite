<?php
// Liste des catégories avec leur nom
$categories_banner = [
    1 => "Ordinateur",
    2 => "Accessoirs",
    3 => "Batteries"
];

$produits = [];

foreach ($categories_banner as $cat_id => $nom_cat) {
    // Requête pour récupérer une image aléatoire pour chaque catégorie
    $sql = "SELECT image_url FROM products WHERE category_id = :cat_id AND image_url IS NOT NULL AND image_url != '' ORDER BY RAND() LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $file = $row['image_url'];
        $path = BASE_URL . "/assets/img/uploads/" . $file;

        $produits[] = [
            'image_url' => $path,
            'categorie' => $cat_id,
            'nom_categorie' => $nom_cat
        ];
    }
}
?>

<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            <?php foreach ($produits as $produit): ?>
                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="<?= htmlspecialchars($produit['image_url']) ?>" alt="IMG-BANNER" class="img-fluid" style="height: 300px; width: auto; object-fit: cover;">

                        <a href="<?= url('afficage_produit.php?categorie=' . $produit['categorie']) ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    <?= htmlspecialchars($produit['nom_categorie']) ?>
                                </span>

                                <span class="block1-info stext-102 trans-04">
                                    Arrivage
                                </span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Acheter
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
