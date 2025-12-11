<?php

session_start();

if (isset($_SESSION['etat']) && $_SESSION['etat'] === "connecte") {
} else {
  header("Location: ../login_admin/login.php");
  exit();
}
include(realpath(__DIR__ . '\\function\db_connection.php'));

// Récupérer les message
$sql = "SELECT * FROM messages ORDER BY date_envoi DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Datatables - Kaiadmin Bootstrap 5 Admin Dashboard</title>
  <meta
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    name="viewport" />
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
    include("./mes_elements/sidebar.php");
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
                class="navbar-brand"
                height="20" />
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
          <div class="page-header">
            <h3 class="fw-bold mb-3">Liste des messages</h3>
          </div>
          <div class="row">

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex align-items-center">
                    <h4 class="card-title">Mes Messages </h4>

                  </div>
                </div>
                <div class="card-body">


                  <div class="table-responsive">
                    <table
                      id="add-row"
                      class="display table table-hover">
                      <thead>
                        <tr>
                          <th>Email</th>
                          <th>Message</th>

                          <th >Repondre</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Email</th>
                          <th>Message</th>

                          <th>Repondre</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <?php if (!empty($messages)) : ?>
                          <?php foreach ($messages as $message) : ?>

                            <?php
                            if ($message['message_staut'] == 'Message_non_lu') : ?>
                              <tr class="table-danger">
                                <td>
                                  <?= htmlspecialchars($message['email']) ?>
                                </td>
                                <td>
                                  <?= htmlspecialchars($message['message']) ?>
                                </td>
                                <td>
                                  <p>Non ouvert</p>
                                </td>

                                <td>
                                  <div class="form-button-action">
                                    <a href="./message_print.php?msg_id=<?= htmlspecialchars($message['id']); ?>">
                                      <button
                                        type="button"
                                        data-bs-toggle="tooltip"
                                        title="Lire"
                                        class="btn btn-link btn-primary btn-lg"
                                        data-original-title="Edit Task">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                      </button>
                                    </a>

                                  </div>
                                </td>


                              </tr>

                            <?php else : ?>
                              <tr class="table-success">
                                <td>
                                  <?= htmlspecialchars($message['email']) ?>
                                </td>
                                <td>
                                  <?= htmlspecialchars($message['message']) ?>
                                </td>
                                <td>
                                  <p>Déjà ouvert</p>
                                </td>

                                <td>
                                  <div class="form-button-action">
                                    <a href="./message_print.php?msg_id=<?= htmlspecialchars($message['id']); ?>">
                                      <button
                                        type="button"
                                        data-bs-toggle="tooltip"
                                        title="Lire"
                                        class="btn btn-link btn-primary btn-lg"
                                        data-original-title="Edit Task">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                      </button>
                                    </a>

                                  </div>
                                </td>


                              </tr>
                            <?php endif; ?>


                          <?php endforeach; ?>

                        <?php else : ?>
                          <p>Aucun produit trouvé dans cette catégorie.</p>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
          <nav class="pull-left">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="http://www.themekita.com">
                  ThemeKita
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> Help </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> Licenses </a>
              </li>
            </ul>
          </nav>
          <div class="copyright">
            2024, made with <i class="fa fa-heart heart text-danger"></i> by
            <a href="http://www.themekita.com">ThemeKita</a>
          </div>
          <div>
            Distributed by
            <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
          </div>
        </div>
      </footer>
    </div>


    <!-- End Custom template -->
  </div>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="./assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <!-- Datatables -->
  <script src="./assets/js/plugin/datatables/datatables.min.js"></script>
  <!-- Kaiadmin JS -->
  <script src="./assets/js/kaiadmin.min.js"></script>
  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="./assets/js/setting-demo2.js"></script>
  <script>
    $(document).ready(function() {
      $("#basic-datatables").DataTable({});

      $("#multi-filter-select").DataTable({
        pageLength: 5,
        initComplete: function() {
          this.api()
            .columns()
            .every(function() {
              var column = this;
              var select = $(
                  '<select class="form-select"><option value=""></option></select>'
                )
                .appendTo($(column.footer()).empty())
                .on("change", function() {
                  var val = $.fn.dataTable.util.escapeRegex($(this).val());

                  column
                    .search(val ? "^" + val + "$" : "", true, false)
                    .draw();
                });

              column
                .data()
                .unique()
                .sort()
                .each(function(d, j) {
                  select.append(
                    '<option value="' + d + '">' + d + "</option>"
                  );
                });
            });
        },
      });

      // Add Row
      $("#add-row").DataTable({
        pageLength: 5,
      });

      var action =
        '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

      $("#addRowButton").click(function() {
        $("#add-row")
          .dataTable()
          .fnAddData([
            $("#addName").val(),
            $("#addDescription").val(),
            $("#addOffice").val(),
            action,
          ]);
        $("#addRowModal").modal("hide");
      });
    });
  </script>
</body>

</html>