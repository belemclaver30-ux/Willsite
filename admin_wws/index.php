<?php
session_start();

if (isset($_SESSION['etat']) && $_SESSION['etat'] === "connecte") {
} else {
  header("Location: ../login_admin/login.php");
  exit();
}
include(realpath(__DIR__ . '\\function\db_connection.php'));
// === Fonctions utiles ===
function compterAdmins($conn)
{
  try {
    $sql = "SELECT COUNT(*) AS total FROM administrateurs";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
  } catch (PDOException $e) {
    return 0;
  }
}

function compterProduitsParCategorie($conn)
{
  try {
    $sql = "SELECT category_id, COUNT(*) AS total FROM products GROUP BY category_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totaux = [];
    foreach ($resultats as $row) {
      $totaux[$row['category_id']] = $row['total'];
    }
    return $totaux;
  } catch (PDOException $e) {
    return [];
  }
}

function compterCommandes($conn)
{
  try {
    $sql = "SELECT COUNT(*) AS total FROM clics_whatsapp";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
  } catch (PDOException $e) {
    return 0;
  }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Tableau de bord wws</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="assets/img/logo.jpg" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
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
        urls: ["assets/css/fonts.min.css"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.min.css" />
  <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="assets/css/demo.css" />
</head>

<body>
  <div class="wrapper">


    <?php
    include("mes_elements/sidebar.php");
    ?>


    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <div class="logo-header" data-background-color="dark">
            <a href="#" class="logo">
              <img src="assets/img/logo.jpg" alt="navbar brand" class="navbar-brand">
            </a>
            <button class="navbar-toggler sidenav-toggler" type="button" data-bs-toggle="collapse"
              data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
          </div>
        </div>

        <!-- Navbar Header -->
        <?php
        include("./mes_elements/navbar.php");
        ?>

        <!-- End Navbar -->
      </div>

      <div class="container">
        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Vue d'ensemble</h3>
              <!-- <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Dashboard</h6> -->
            </div>
            <!-- <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                <a href="#" class="btn btn-primary btn-round">Add Customer</a>
              </div> -->
          </div>
          <div class="row">
            <?php
            $nbAdmins = compterAdmins($conn);
            ?>

            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div class="icon-big text-center icon-primary bubble-shadow-small">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Administrateurs</p>
                        <h4 class="card-title"><?= $nbAdmins ?></h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php
            $totaux = compterProduitsParCategorie($conn);

            // Exemple d’association id => nom
            $categories = [
              1 => ['label' => 'Ordinateurs', 'icon' => 'fas fa-laptop'],
              2 => ['label' => 'Accessoires', 'icon' => 'fas fa-headphones'],
              3 => ['label' => 'Batteries', 'icon' => 'fas fa-battery-half'],
              4 => ['label' => 'USB', 'icon' => 'fas fa-usb'],
              5 => ['label' => 'Chargeurs', 'icon' => 'fas fa-plug']
            ];

            foreach ($categories as $id => $cat) {
              $nb = $totaux[$id] ?? 0;
              ?>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                          <i class="<?= $cat['icon'] ?>"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category"><?= $cat['label'] ?></p>
                          <h4 class="card-title"><?= $nb ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>




            <?php $nbCommandes = compterCommandes($conn); ?>

            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div class="icon-big text-center icon-success bubble-shadow-small">
                        <i class="fas fa-luggage-cart"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Commandes</p>
                        <h4 class="card-title"><?= $nbCommandes ?></h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>




        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card card-round">
              <div class="card-body">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Nouveau message(s)</div>
                  <div class="card-tools">
                    <div class="dropdown">
                      <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      </button>
                      
                    </div>
                  </div>
                </div>
                <div class="card-list py-4">
                  <div class="card-list py-4">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM messages WHERE message_staut= 'Message_non_lu' ORDER BY date_envoi DESC LIMIT 10");
                    $stmt->execute();
                    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($messages as $row) {
                      ?>
                      <div class="item-list">
                        <div class="avatar">
                          <span class="avatar-title rounded-circle border border-white bg-info">
                            <?= strtoupper(substr($row['email'], 0, 1)) ?>
                          </span>
                        </div>
                        <div class="info-user ms-3">
                          <div class="username"><?= htmlspecialchars($row['email']) ?></div>
                          <div class="status"><?= htmlspecialchars($row['message']) ?></div>
                        </div>
                        <a href="./message_print.php?msg_id=<?= htmlspecialchars($row['id']); ?>">

                          <button class="btn btn-icon btn-link op-8 me-1" title="<?= $row['date_envoi'] ?>">
                            <i class="fas fa-envelope fa-2x"></i>
                          </button>

                        </a>
                      </div>
                    <?php } ?>
                  </div>


                </div>
              </div>
            </div>

            <!-- historique -->

          </div>
        </div>
      </div>

      <?php
      include("./mes_elements/footer.php");
      ?>

    </div>

    <!-- Custom template | don't include it in your project! -->
    <div class="custom-template">
      <div class="title">Settings</div>
      <div class="custom-content">
        <div class="switcher">
          <div class="switch-block">
            <h4>Logo Header</h4>
            <div class="btnSwitch">
              <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
              <br />
              <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Navbar Header</h4>
            <div class="btnSwitch">
              <button type="button" class="changeTopBarColor" data-color="dark"></button>
              <button type="button" class="changeTopBarColor" data-color="blue"></button>
              <button type="button" class="changeTopBarColor" data-color="purple"></button>
              <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
              <button type="button" class="changeTopBarColor" data-color="green"></button>
              <button type="button" class="changeTopBarColor" data-color="orange"></button>
              <button type="button" class="changeTopBarColor" data-color="red"></button>
              <button type="button" class="selected changeTopBarColor" data-color="white"></button>
              <br />
              <button type="button" class="changeTopBarColor" data-color="dark2"></button>
              <button type="button" class="changeTopBarColor" data-color="blue2"></button>
              <button type="button" class="changeTopBarColor" data-color="purple2"></button>
              <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
              <button type="button" class="changeTopBarColor" data-color="green2"></button>
              <button type="button" class="changeTopBarColor" data-color="orange2"></button>
              <button type="button" class="changeTopBarColor" data-color="red2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Sidebar</h4>
            <div class="btnSwitch">
              <button type="button" class="changeSideBarColor" data-color="white"></button>
              <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
              <button type="button" class="changeSideBarColor" data-color="dark2"></button>
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
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Chart JS -->
  <script src="assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="assets/js/plugin/jsvectormap/world.js"></script>

  <!-- Sweet Alert -->
  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="assets/js/setting-demo.js"></script>
  <script src="assets/js/demo.js"></script>
  <script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#177dff",
      fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#f3545d",
      fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#ffa534",
      fillColor: "rgba(255, 165, 52, .14)",
    });
  </script>
</body>

</html>