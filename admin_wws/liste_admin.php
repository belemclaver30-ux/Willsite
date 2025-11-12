<?php

session_start();

if (isset($_SESSION['etat']) && $_SESSION['etat'] === "connecte") {
} else {
  header("Location: ../login_admin/login.php");
  exit();
}
include(realpath(__DIR__ . '\\function\db_connection.php'));



// Récupérer la liste des administrateurs
$sql = "SELECT * FROM administrateurs";
$stmt = $conn->prepare($sql);
$stmt->execute();
$administrateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Datatables</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="./assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

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
              <img src="./assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
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
            <h3 class="fw-bold mb-3">Liste des Administrateurs</h3>
            <ul class="breadcrumbs mb-3">
              <li class="nav-home">
                <a href="#">
                  <i class="icon-home"></i>
                </a>
              </li>
              <li class="separator">
                <i class="icon-arrow-right"></i>
              </li>
              <li class="nav-item">
                <a href="#">Tables</a>
              </li>
              <li class="separator">
                <i class="icon-arrow-right"></i>
              </li>
              <li class="nav-item">
                <a href="#">Datatables</a>
              </li>
            </ul>
          </div>
          <div class="row">

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex align-items-center">
                    
                      <button id="btn-ajouter-admin" style="margin-left: 500px;" class="btn btn-primary btn-round ms-auto"
                        data-bs-toggle="modal" data-bs-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Ajouter un administrateur
                      </button>

                    
                  </div>
                </div>
                <div class="card-body">
                  <!-- Modal Add/Edit administrateur -->
                  <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header border-0">
                          <h5 class="modal-title">
                            <span class="fw-mediumbold">Nouveau</span>
                            <span class="fw-light">administrateur</span>
                          </h5>
                          <button type="button" class="close" onclick="$('#addRowModal').modal('hide')"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <form id="administrateurForm" action="add_admin.php" method="POST" enctype="multipart/form-data">
                          <div class="modal-body">
                            <p class="small">Remplissez tous les champs pour ajouter ou modifier </p>

                            <input type="hidden" name="id" id="administrateurId">

                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <label>Nom</label>
                                  <input id="administrateurName" name="form_admin_nom" type="text" class="form-control" required />
                                </div>
                              </div>

                              <div class="col-md-6 pe-0">
                                <div class="form-group form-group-default">
                                  <label>Prenom</label>
                                  <input id="administrateurPrenom" name="form_admin_prenom" type="text" class="form-control"
                                    required />
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Email</label>
                                  <input id="administrateuremail" name="form_admin_email" type="email" class="form-control"
                                    required />
                                </div>
                              </div>


                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Mot de passe</label>
                                  <input id="administrateurMot_de_passe" name="form_admin_Mot_de_passe" type="password" class="form-control"
                                    required />
                                </div>
                              </div>


                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Poste</label>
                                  <input id="administrateurposte" name="form_admin_poste" type="poste" class="form-control"
                                    required />
                                </div>
                              </div>


                              <div class="form-group form-group-default">
                                <label>Sexe</label><br />
                                <div class="d-flex">
                                  <select id="administrateurSexe" name="form_admin_sexe">
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group form-group-default">
                                <label>Statut</label><br />
                                <div class="d-flex">
                                  <select id="administrateurStatut" name="form_admin_statut">
                                    <option value="admin">Admin</option>
                                    <option value="gestion">Gestion</option>
                                  </select>
                                </div>
                              </div>

                            </div>
                          </div>





                          <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-danger"
                              onclick="$('#addRowModal').modal('hide')">Fermer</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Script JS pour remplir automatiquement les champs -->
                  <script>
                    document.addEventListener('DOMContentLoaded', function() {
                      const editButtons = document.querySelectorAll('.btn-edit');
                      editButtons.forEach(btn => {
                        btn.addEventListener('click', function() {
                          document.getElementById('administrateurId').value = this.dataset.id;
                          document.getElementById('administrateurName').value = this.dataset.name;
                          document.getElementById('administrateurPrenom').value = this.dataset.prenom;
                          document.getElementById('administrateuiemail').value = this.dataset.email;
                          document.getElementById('administrateurMot_de_passe').value = this.dataset.Mot_de_passe;
                          document.getElementById('administrateurposte').value = this.dataset.poste;
                          document.getElementById('administrateurSexe').value = this.dataset.sexe;
                          document.getElementById('administrateurStatut').value = this.dataset.statut;



                          // Mettre le formulaire en mode modification
                          document.querySelector('#addRowModal .modal-title').innerHTML = '<span class="fw-mediumbold">Modifier</span> <span class="fw-light">Produit</span>';
                          document.getElementById('administrateurForm').action = 'edit_admin.php';
                          document.querySelector('#addRowModal button[type=submit]').innerText = 'Mettre à jour';
                        });
                      });
                    });

                    function resetAddModal() {
                      document.getElementById('administrateurId').value = '';
                      document.getElementById('administrateurName').value = '';
                      document.getElementById('administrateurPrenom').value = '';
                      document.getElementById('administrateuremail').value = '';
                      document.getElementById('administrateurMot_de_passe').value = '';
                      document.getElementById('administrateurposte').value = '';
                      document.getElementById('administrateurSexe').value = '';
                      document.getElementById('administrateurStatut').value = '';
                      document.querySelector('#addRowModal .modal-title').innerHTML = '<span class="fw-mediumbold">Nouveau</span> <span class="fw-light">Produit</span>';
                      document.getElementById('administrateurForm').action = 'add_admin.php';
                      document.querySelector('#addRowModal button[type=submit]').innerText = 'Ajouter';
                    }
                  </script>



                </div>

                <div class="table-responsive">
                  <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Prenom</th>
                        <th>email</th>
                        <th>Poste</th>
                        <th>sexe</th>
                        <th>Statut</th>


                        <th style="width: 10%">Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Prenom</th>
                        <th>email</th>
                        <th>Poste</th>
                        <th>sexe</th>
                        <th>Statut</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <!-- Tableau des produits -->
                      <?php if (!empty($administrateurs)): ?>
                        <?php foreach ($administrateurs as $administrateur): ?>
                          <tr>
                            <td><?= htmlspecialchars($administrateur['nom']) ?></td>
                            <td><?= htmlspecialchars($administrateur['prenom']) ?></td>
                            <td><?= htmlspecialchars($administrateur['email']) ?></td>
                            <td><?= htmlspecialchars($administrateur['Poste']) ?></td>
                            <td><?= htmlspecialchars($administrateur['sexe']) ?></td>
                            <td><?= htmlspecialchars($administrateur['statut']) ?></td>


                            <td>
                              <div class="form-button-action">
                                <a href="delete_admin.php?a_supprimer_id=<?= $administrateur['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?');" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Supprimer">
                                  <i class="fa fa-times"></i>
                                </a>
                                <a href="edit_admin.php" class="btn btn-link btn-danger btn-edit" data-bs-toggle="modal" data-bs-target="#addRowModal"
                                  data-id="<?= $administrateur['id'] ?>"
                                  data-name="<?= htmlspecialchars($administrateur['nom']) ?>"
                                  data-prenom="<?= htmlspecialchars($administrateur['prenom']) ?>"
                                  data-email="<?= htmlspecialchars($administrateur['email']) ?>"
                                  data-email="<?= htmlspecialchars($administrateur['mot_de_passe']) ?>"
                                  data-poste="<?= htmlspecialchars($administrateur['Poste']) ?>"
                                  data-sexe="<?= htmlspecialchars($administrateur['sexe']) ?>"
                                  data-statut="<?= htmlspecialchars($administrateur['statut']) ?>"
                                  title="Modifier">
                                  <i class="fa fa-edit"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <p>Aucun produit trouvé dans cette catégorie.</p>
                      <?php endif; ?>



                      <script>
                        // Réinitialise les champs du formulaire pour l'ajout
                        function resetAddModal() {
                          document.getElementById('administrateurId').value = '';
                          document.getElementById('administrateurName').value = '';
                          document.getElementById('administrateurPrenom').value = '';
                          document.getElementById('administrateuremail').value = '';
                          document.getElementById('administrateurMot_de_passe').value = '';
                          document.getElementById('administrateurposte').value = '';
                          document.getElementById('administrateurSexe').value = '';
                          document.getElementById('administrateurStatut').value = '';
                          document.querySelector('#addRowModal .modal-title').innerHTML = '<span class="fw-mediumbold">Nouveau</span> <span class="fw-light">administrateur</span>';
                          document.getElementById('administrateurForm').action = 'enregistrer_admin.php';
                          document.querySelector('#addRowModal button[type=submit]').innerText = 'Ajouter';
                        }

                        // Quand on clique sur "Ajouter", on réinitialise le formulaire
                        document.addEventListener('DOMContentLoaded', function() {
                          const btnAjouter = document.getElementById('btn-ajouter-admin');
                          if (btnAjouter) {
                            btnAjouter.addEventListener('click', function() {
                              resetAddModal();
                            });
                          }
                        });
                      </script>









                    </tbody>
                  </table>
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

    <!-- Custom template | don't include it in your project! -->
    <div class="custom-template">
      <div class="title">Settings</div>
      <div class="custom-content">
        <div class="switcher">
          <div class="switch-block">
            <h4>Logo Header</h4>
            <div class="btnSwitch">
              <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
              <button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
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
              <button type="button" class="changeTopBarColor" data-color="white"></button>
              <br />
              <button type="button" class="changeTopBarColor" data-color="dark2"></button>
              <button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
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
              <button type="button" class="selected changeSideBarColor" data-color="white"></button>
              <button type="button" class="changeSideBarColor" data-color="dark"></button>
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