<head>
    <title><?= isset($pageTitle) ? escape($pageTitle) : 'Willsite - Boutique Informatique' ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?= asset('img/images/icons/favicon.png') ?>" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= url('public/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= asset('fonts/iconic/css/material-design-iconic-font.min.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= asset('fonts/linearicons-v1.0.0/icon-font.min.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= url('public/vendor/animate/animate.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= url('public/vendor/css-hamburgers/hamburgers.min.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= url('public/vendor/animsition/css/animsition.min.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= url('public/vendor/select2/select2.min.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= url('public/vendor/daterangepicker/daterangepicker.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= url('public/vendor/slick/slick.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= url('public/vendor/MagnificPopup/magnific-popup.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= url('public/vendor/perfect-scrollbar/perfect-scrollbar.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= asset('css/util.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('css/main.css') ?>">
    <!--===============================================================================================-->

    <style>
        .product-details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .product-details th,
        .product-details td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .product-details thead th {
            background-color: #0066cc;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
        }

        .product-details tbody tr:hover {
            background-color: #f1f1f1;
        }

        .product-details td {
            color: #333;
            font-size: 15px;
        }

        .product-details th {
            width: 30%;
            color: #0066cc;
            font-weight: 600;
        }
    </style>

</head>
