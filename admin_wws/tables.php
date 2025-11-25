<?php

session_start();

if (isset($_SESSION['etat']) && $_SESSION['etat'] === "connecte") {
} else {
  header("Location: ../login_admin/login.php");
  exit();
}
include(realpath(__DIR__ . '\\function\db_connection.php'));

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Forms - Kaiadmin Bootstrap 5 Admin Dashboard</title>
  <meta
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    name="viewport"/>
  <link
    rel="icon"
    href="./assets/img/kaiadmin/favicon.ico"
    type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="./assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["./assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/css/plugins.min.css" />
  <link rel="stylesheet" href="./assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="./assets/css/demo.css" />
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <?php
    include("mes_elements/sidebar.php");
    ?>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="./index.html" class="logo">
              <img
                src="./assets/img/kaiadmin/logo_light.svg"
                alt="navbar brand"
                class="navbar-brand" />
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
        <!-- Navbar Header -->
        <?php
        include("./mes_elements/navbar.php");
        ?>
        <!-- End Navbar -->
      </div>

      <div class="container">
        <div class="page-inner">
          <div class="row">/Willsite
            <div class="col-md-12">
              <form action="/Willsite/admin_wws/function/enregistrer_admin.php" method="POST">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Formulaire à remplir</div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="nom">Nom</label>
                          <input type="text" class="form-control" name="nom" placeholder="Entrez votre nom...." required />
                        </div>
                        <div class="form-group">
                          <label for="prenom">Prenom</label>
                          <input type="text" class="form-control" name="prenom" placeholder="Entrez votre prénom...." required />
                        </div>
                        <div class="form-group">
                          <label for="email">Adresse email</label>
                          <input type="email" class="form-control" name="email" placeholder="Entrez votre adresse email...." required />
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="poste">Poste Occupé</label>
                          <input type="text" class="form-control" name="poste" placeholder="Entrez votre poste...." required />
                        </div>
                        <div class="form-group">
                          <label for="mot_de_passe">Mot de passe</label>
                          <input type="password" class="form-control" name="mot_de_passe" placeholder="Votre mot de passe" required />
                        </div>
                        <div class="form-group">
                          <label for="verif_mot_de_passe">Vérification du mot de passe</label>
                          <input type="password" class="form-control" name="verif_mot_de_passe" placeholder="Confirmez votre mot de passe" required />
                        </div>
                        <div class="form-group">
                          <label>Sexe</label><br />
                          <div class="d-flex">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="sexe" value="Homme" id="homme" required />
                              <label class="form-check-label" for="homme">Homme</label>
                            </div>
                            <div class="form-check ml-3">
                              <input class="form-check-input" type="radio" name="sexe" value="Femme" id="femme" />
                              <label class="form-check-label" for="femme">Femme</label>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label>Statut</label><br />
                          <div class="d-flex">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="statut" value="admin" id="admin" required />
                              <label class="form-check-label" for="admin">admin</label>
                            </div>
                            <div class="form-check ml-3">
                              <input class="form-check-input" type="radio" name="statut" value="gestion" id="gestion" />
                              <label class="form-check-label" for="gestion">gestion</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-action">
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      
    header("Location: liste_admin.php?deleted=1"); // Redirection après suppression
    exit();

    </div>



  </div>
  <?php
  include("./mes_elements/footer.php");
  ?>
  <!-- Custom template | don't include it in your project! -->
  <div class="custom-template">
    <div class="title">Settings</div>
    <div class="custom-content">
      <div class="switcher">
        <div class="switch-block">
          <h4>Logo Header</h4>
          <div class="btnSwitch">
            <button
              type="button"
              class="selected changeLogoHeaderColor"
              data-color="dark"></button>
            <button
              type="button"
              class="selected changeLogoHeaderColor"
              data-color="blue"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="purple"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="light-blue"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="green"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="orange"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="red"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="white"></button>
            <br />
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="dark2"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="blue2"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="purple2"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="light-blue2"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="green2"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="orange2"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="red2"></button>
          </div>
        </div>
        <div class="switch-block">
          <h4>Navbar Header</h4>
          <div class="btnSwitch">
            <button
              type="button"
              class="changeTopBarColor"
              data-color="dark"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="blue"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="purple"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="light-blue"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="green"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="orange"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="red"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="white"></button>
            <br />
            <button
              type="button"
              class="changeTopBarColor"
              data-color="dark2"></button>
            <button
              type="button"
              class="selected changeTopBarColor"
              data-color="blue2"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="purple2"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="light-blue2"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="green2"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="orange2"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="red2"></button>
          </div>
        </div>
        <div class="switch-block">
          <h4>Sidebar</h4>
          <div class="btnSwitch">
            <button
              type="button"
              class="selected changeSideBarColor"
              data-color="white"></button>
            <button
              type="button"
              class="changeSideBarColor"
              data-color="dark"></button>
            <button
              type="button"
              class="changeSideBarColor"
              data-color="dark2"></button>
          </div>
        </div>
      </div>
    </div>
    <div class="custom-toggle">
      <i class="icon-settings"></i>
    </div>
  </div>
  <!-- End Custom template -->
  </div>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="./assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Chart JS -->
  <script src="./assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="./assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="./assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="./assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="./assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="./assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="./assets/js/plugin/jsvectormap/world.js"></script>

  <!-- Google Maps Plugin -->
  <script src="./assets/js/plugin/gmaps/gmaps.js"></script>

  <!-- Sweet Alert -->
  <script src="./assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="./assets/js/kaiadmin.min.js"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="./assets/js/setting-demo2.js"></script>
</body>

</html>