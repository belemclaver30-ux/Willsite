<?php
include(realpath(__DIR__ . '\\function\db_connection.php'));

// Vérifier si une catégorie est passée en paramètre
$message_id = isset($_GET['msg_id']) ? (int) $_GET['msg_id'] : null;


if ($message_id) {
    $messagerie_query = $conn->prepare("UPDATE messages SET message_staut='Message_lu' WHERE id = :message_id");
    $messagerie_query->bindValue(':message_id', $message_id, PDO::PARAM_INT);
    $messagerie_query->execute();

    $messagerie_query2 = $conn->prepare("SELECT * FROM messages WHERE id = :message_id");
    $messagerie_query2->bindValue(':message_id', $message_id, PDO::PARAM_INT);
    $messagerie_query2->execute();
    $message = $messagerie_query2->fetch(PDO::FETCH_ASSOC);

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
            active: function() {
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
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Vue d'ensemble</h3>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-round">
                                <div class="card-body">

                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">
                                                <?= htmlspecialchars($message['email']) ?>
                                            </h4>
                                            <p>
                                                <small class="text-muted"><i class="far fa-paper-plane"></i>
                                                    <?= htmlspecialchars($message['date_envoi']) ?>
                                                </small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>
                                                <?= htmlspecialchars($message['message']) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- historique -->

                        </div>
                    </div>

                </div>



            </div>

        </div>

        <?php
        include("./mes_elements/footer.php");
        ?>

    </div>

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