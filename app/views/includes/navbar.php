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
                <a href="<?= url('public/index.php') ?>" class="logo">
                    <img src="<?= asset('img/images/photo site/new/logo.jpg') ?>" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="<?= ($page_active == 'index') ? 'active-menu' : ''; ?>">
                            <a href="<?= url('public/index.php') ?>">Accueil</a>
                        </li>

                        <li class="<?= ($page_active == 'boutique') ? 'active-menu' : ''; ?>">
                            <a href="#">Votre boutique</a>
                            <ul class="sub-menu">
                                <?php foreach ($categories as $categorie): ?>
                                    <li><a href="<?= url('public/afficage_produit.php?categorie=' . $categorie['category_id']) ?>"><?= escape($categorie['name']) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>

                        <li class="<?= ($page_active == 'about') ? 'active-menu' : ''; ?>">
                            <a href="<?= url('public/about.php') ?>">À propos</a>
                        </li>

                        <li class="<?= ($page_active == 'contact') ? 'active-menu' : ''; ?>">
                            <a href="<?= url('public/contact.php') ?>">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="0">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                    <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="<?= url('public/index.php') ?>"><img src="<?= asset('img/images/photo site/new/logo.jpg') ?>" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="0">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li>
                <a href="<?= url('public/index.php') ?>">Accueil</a>
            </li>

            <li>
                <a href="#">Votre boutique</a>
                <ul class="sub-menu-m">
                    <?php foreach ($categories as $categorie): ?>
                        <li><a href="<?= url('public/afficage_produit.php?categorie=' . $categorie['category_id']) ?>"><?= escape($categorie['name']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>

            <li>
                <a href="<?= url('public/about.php') ?>">À propos</a>
            </li>

            <li>
                <a href="<?= url('public/contact.php') ?>">Contact</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="<?= asset('img/images/icons/icon-close2.png') ?>" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Rechercher...">
            </form>
        </div>
    </div>
</header>
