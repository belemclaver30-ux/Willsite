<?php
session_start();

if (isset($_SESSION['etat']) && $_SESSION['etat'] === "connecte") {
} else {
  header("Location: ../login_admin/login.php");
  exit();
}
include(realpath(__DIR__ . '\\function\db_connection.php'));
// Vérifier si une catégorie est passée en paramètre
$category_id = isset($_GET['categorie']) ? (int) $_GET['categorie'] : null;

// Préparer une variable pour le nom de la catégorie (par défaut "Tous les produits")
$category_name = "Tous les produits";
// var_dump($category_id);
// die();

// Requête SQL pour récupérer les produits par catégorie
if ($category_id) {
  // Obtenir le nom de la catégorie
  $category_query = $conn->prepare("SELECT name FROM categories WHERE category_id = :category_id");
  $category_query->bindValue(':category_id', $category_id, PDO::PARAM_INT);
  $category_query->execute();
  $category = $category_query->fetch(PDO::FETCH_ASSOC);

  // Si la catégorie existe, modifier le titre
  if ($category) {
    $category_name = $category['name'];
  }

  // Récupérer les produits de la catégorie
  $sql = "SELECT * FROM products WHERE category_id = :category_id";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
} else {
  // Afficher tous les produits si aucune catégorie n'est sélectionnée
  $sql = "SELECT * FROM products";
  $stmt = $conn->prepare($sql);
}

// Exécuter la requête
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);



//choix de categories dynamique
$categories = [];
$catQuery = $conn->query("SELECT category_id, name FROM categories");
if ($catQuery) {
  $categories = $catQuery->fetchAll(PDO::FETCH_ASSOC);
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Datatables </title>
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
         
          <div class="row">

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex align-items-center">
                    <h4 class="card-title">Mes Produids > <?= htmlspecialchars($category_name) ?></h4>
                    <button type="button" class="btn btn-primary  btn-round ms-auto" onclick="resetAddModal()" data-bs-toggle="modal" data-bs-target="#addRowModal" style="margin-left: 500px;">
                      <i class="fa fa-plus"></i>
                      Ajouter un produit
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <!-- Modal Add/Edit Product -->
                  <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header border-0">
                          <h5 class="modal-title">
                            <span class="fw-mediumbold">Nouveau</span>
                            <span class="fw-light">Produit</span>
                          </h5>
                          <button type="button" class="close" onclick="$('#addRowModal').modal('hide')" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <form id="productForm" action="function/add_product.php" method="POST" enctype="multipart/form-data">
                          <div class="modal-body">
                            <p class="small">Remplissez tous les champs pour ajouter ou modifier un produit</p>

                            <input type="hidden" name="product_id" id="productId">
                            <input type="hidden" name="existing_image" id="existingImage">

                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <label>Nom</label>
                                  <input id="productName" name="produit_name" type="text" class="form-control" required />
                                </div>
                              </div>

                              <div class="col-md-6 pe-0">
                                <div class="form-group form-group-default">
                                  <label>Processeur</label>
                                  <input id="productProcesseur" name="produit_processeur" type="text" class="form-control" required />
                                </div>
                              </div>

                              <div class="col-md-6 pe-0">
                                <div class="form-group form-group-default">
                                  <label>Stockage</label>
                                  <input id="productStockage" name="produit_stockage" type="text" class="form-control" required />
                                </div>
                              </div>

                              <div class="col-md-6 pe-0">
                                <div class="form-group form-group-default">
                                  <label>Écran</label>
                                  <input id="productÉcran" name="produit_ecran" type="number" class="form-control" required />
                                </div>
                              </div>

                              <div class="col-md-6 pe-0">
                                <div class="form-group form-group-default">
                                  <label>RAM</label>
                                  <input id="productRAM" name="produit_ram" type="text" class="form-control" required />
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Prix</label>
                                  <input id="productPrix" name="produit_prix" type="number" step="0.01" class="form-control" required />
                                </div>
                              </div>

                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <label>Catégorie</label>
                                  <select id="productCategory" name="category_id" class="form-control" required>
                                    <option value="">-- Choisir une catégorie --</option>
                                    <?php foreach ($categories as $cat): ?>
                                      <option value="<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>

                              <div class="col-sm-12">
                                <div class="form-group form-group-default">

                                  <label>Image principale :</label>
                                  <input type="file" name="image" required><br>

                                  
                                  <label>Image 1 :</label>
                                  <input type="file" name="first_image"><br>

                                  <label>Image 2 :</label>
                                  <input type="file" name="second_image"><br>

                                  <label>Image 3 :</label>
                                  <input type="file" name="third_image"><br>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-danger" onclick="$('#addRowModal').modal('hide')">Fermer</button>
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
                          document.getElementById('productId').value = this.dataset.id;
                          document.getElementById('productName').value = this.dataset.name;
                          document.getElementById('productProcesseur').value = this.dataset.processeur;
                          document.getElementById('productStockage').value = this.dataset.stockage;
                          document.getElementById('productÉcran').value = this.dataset.écran;
                          document.getElementById('productRAM').value = this.dataset.ram;
                          document.getElementById('productPrix').value = this.dataset.prix;
                          document.getElementById('productCategory').value = this.dataset.category;
                          document.getElementById('existingImage').value = this.dataset.image;
                          document.getElementById('existingfirst_image').value = this.dataset.first_image;
                          document.getElementById('existingsecond_image').value = this.dataset.seconde_image;
                          document.getElementById('existingthird_image').value = this.dataset.third_image;


                          // Mettre le formulaire en mode modification
                          document.querySelector('#addRowModal .modal-title').innerHTML = '<span class="fw-mediumbold">Modifier</span> <span class="fw-light">Produit</span>';
                          document.getElementById('productForm').action = 'edit_product.php';
                          document.querySelector('#addRowModal button[type=submit]').innerText = 'Mettre à jour';
                        });
                      });
                    });

                    function resetAddModal() {
                      document.getElementById('productId').value = '';
                      document.getElementById('productName').value = '';
                      document.getElementById('productProcesseur').value = '';
                      document.getElementById('productStockage').value = '';
                      document.getElementById('productÉcran').value = '';
                      document.getElementById('productRAM').value = '';
                      document.getElementById('productPrix').value = '';
                      document.getElementById('productCategory').value = '';
                      document.getElementById('existingImage').value = '';
                      document.getElementById('existingfirst_image').value = '';
                      document.getElementById('existingsecond_image').value = '';
                      document.getElementById('existingthird_image').value = '';
                      document.querySelector('#addRowModal .modal-title').innerHTML = '<span class="fw-mediumbold">Nouveau</span> <span class="fw-light">Produit</span>';
                      document.getElementById('productForm').action = 'function/add_product.php';
                      document.querySelector('#addRowModal button[type=submit]').innerText = 'Ajouter';
                    }
                  </script>



                </div>

                <div class="table-responsive">
                  <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Processeur</th>
                        <th>Stockage</th>
                        <th>Écran </th>
                        <th>RAM</th>
                        <th>Prix</th>
                        <th>Image</th>

                        <th style="width: 10%">Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Processeur</th>
                        <th>Stockage</th>
                        <th>Écran </th>
                        <th>RAM</th>
                        <th>Prix</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <!-- Tableau des produits -->
                      <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                          <tr>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= htmlspecialchars($product['processeur']) ?></td>
                            <td><?= htmlspecialchars($product['stockage']) ?></td>
                            <td><?= htmlspecialchars($product['ecran']) ?></td>
                            <td><?= htmlspecialchars($product['ram']) ?></td>
                            <td><?= number_format($product['prix'], 0, ',', ' ') ?> FCFA</td>
                            <td> <img src="../assets/img/uploads/<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style=" width: 60px;height: auto;object-fit: cover; border-radius: 5px; ">

                            </td>

                            <td>
                              <div class="form-button-action">
                                <a href="delete_product.php?a_supprimer_id=<?= $product['product_id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?');" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Supprimer">
                                  <i class="fa fa-times"></i>
                                </a>
                                <a href="#" class="btn btn-link btn-danger btn-edit" data-bs-toggle="modal" data-bs-target="#addRowModal"
                                  data-id="<?= $product['product_id'] ?>"
                                  data-name="<?= htmlspecialchars($product['name']) ?>"
                                  data-processeur="<?= htmlspecialchars($product['processeur']) ?>"
                                  data-stockage="<?= htmlspecialchars($product['stockage']) ?>"
                                  data-ecran="<?= htmlspecialchars($product['ecran']) ?>"
                                  data-ram="<?= htmlspecialchars($product['ram']) ?>"
                                  data-prix="<?= htmlspecialchars($product['prix']) ?>"
                                  data-category="<?= htmlspecialchars($product['category_id']) ?>"
                                  data-image="<?= htmlspecialchars($product['image_url']) ?>"
                                  data-image1="<?= htmlspecialchars($product['first_image']) ?>"
                                  data-image2="<?= htmlspecialchars($product['second_image']) ?>"
                                  data-image3="<?= htmlspecialchars($product['third_image']) ?>"
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