<?php
// Récupérer les catégories
$sql = "SELECT * FROM categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">
                <!-- Logo desktop -->
                <a href="<?= url('index.php') ?>" class="logo">
                    <img src="<?= asset('img/images/photo site/new/logo.jpg') ?>" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="<?= ($page_active == 'index') ? 'active-menu' : ''; ?>">
                            <a href="<?= url('index.php') ?>">Accueil</a>
                        </li>

                        <li class="<?= ($page_active == 'boutique') ? 'active-menu' : ''; ?>">
                            <a href="#">Votre boutique</a>
                            <ul class="sub-menu">
                                <?php foreach ($categories as $categorie): ?>
                                    <li><a href="<?= url('afficage_produit.php?categorie=' . htmlspecialchars($categorie['category_id'])) ?>"><?= htmlspecialchars($categorie['name']) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>

                        <li class="<?= ($page_active == 'about') ? 'active-menu' : ''; ?>">
                            <a href="<?= url('about.php') ?>">À propos</a>
                        </li>

                        <li class="<?= ($page_active == 'contact') ? 'active-menu' : ''; ?>">
                            <a href="<?= url('contact.php') ?>">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo mobile -->
        <div class="logo-mobile">
            <a href="<?= url('index.php') ?>"><img src="<?= asset('img/images/photo site/new/logo.jpg') ?>" alt="IMG-LOGO"></a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>

    <!-- Menu mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li><a href="<?= url('index.php') ?>">Accueil</a></li>
            <li>
                <a href="#">Votre boutique</a>
                <ul class="sub-menu-m">
                    <?php foreach ($categories as $categorie): ?>
                        <li><a href="<?= url('afficage_produit.php?categorie=' . htmlspecialchars($categorie['category_id'])) ?>"><?= htmlspecialchars($categorie['name']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>
            <li><a href="<?= url('about.php') ?>">À propos</a></li>
            <li><a href="<?= url('contact.php') ?>">Contact</a></li>
        </ul>
    </div>
</header>
