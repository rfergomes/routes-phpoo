<!DOCTYPE html>
<html lang="pt-BR">
<head>
<title><?= $this->e($title) ?></title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Flat Able is trending dashboard template made using Bootstrap 5 design framework. Flat Able is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
    <meta name="keywords"
        content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
    <meta name="author" content="phoenixcoded">

    <!-- [Favicon] icon -->
    <link rel="icon" href="<?= getenv('APP_URL') ?>/assets/images/logo32.png" type="image/x-icon">
    <!-- [Google Font : Public Sans] icon -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="<?= getenv('APP_URL') ?>/assets/fonts/tabler-icons.min.css">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="<?= getenv('APP_URL') ?>/assets/fonts/feather.css">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="<?= getenv('APP_URL') ?>/assets/fonts/fontawesome.css">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="<?= getenv('APP_URL') ?>/assets/fonts/material.css">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="<?= getenv('APP_URL') ?>/assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="<?= getenv('APP_URL') ?>/assets/css/style-preset.css">
    <!-- [Template CSS Files] -->
    <?= $this->section('css') ?>
</head>
<body class="auth-body">
    <?= $this->section('content') ?>
</body>
</html>
