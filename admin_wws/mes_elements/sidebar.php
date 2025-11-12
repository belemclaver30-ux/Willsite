<!-- Sidebar -->
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$statut = $_SESSION['statut'];
?>
<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="index.php" class="logo">

        <img
          src="./assets/img/logo.jpg"
          alt="logo"
          class="navbar-brand"
          height="50"
          style="border-radius:10px;" />
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <?php
      $currentPage = basename($_SERVER['PHP_SELF']);
      ?>

      <ul class="nav nav-secondary">

        <!-- Accueil -->
        <li class="nav-item <?= ($currentPage == 'index.php') ? 'active' : '' ?>">
          <a href="index.php">
            <i class="fas fa-home"></i>
            <p>Accueil</p>
          </a>
        </li>

        <!-- Section Articles -->
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Gestion des Articles</h4>
        </li>

        <li class="nav-item <?= ($currentPage == 'liste_articles.php') ? 'active' : '' ?>">
          <a href="liste_articles.php">
            <p>Liste des articles</p>
          </a>
        </li>

        <li class="nav-item <?= ($currentPage == 'tablesarticle.php') ? 'active' : '' ?>">
          <a href="tablesarticle.php">
            <p>Catégories d'articles</p>
          </a>
        </li>

        <?php if ($statut !== 'gestion'): ?>
          <!-- Gestion des Administrateurs -->
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Gestion des Administrateurs</h4>
          </li>
          <li class="nav-item <?= ($currentPage == 'liste_admin.php') ? 'active' : '' ?>">
            <a href="liste_admin.php">
              <p>Liste des Administrateurs</p>
            </a>
          </li>

        <?php endif; ?>


        <!-- Section Clients -->
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Gestion des messages</h4>
        </li>

        <li class="nav-item <?= ($currentPage == 'messages.php') ? 'active' : '' ?>">
          <a href="messages.php">
            <p>Messages</p>
          </a>
        </li>


        <li class="nav-item">
          <a href="function/deconnecter.php">
            <p>Se deconnecter</p>
          </a>
        </li>

      </ul>



    </div>
  </div>
</div>
<!-- End Sidebar -->