<!DOCTYPE html>
<html lang="pt-br">

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
    <link rel="icon" href="<?= getenv('APP_URL') ?>/assets/images/favicon.svg" type="image/x-icon">
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

<body data-pc-preset="preset-1" data-pc-sidebar-theme="dark" data-pc-sidebar-caption="true" data-pc-direction="ltr"
    data-pc-theme="light" data-pc-header-theme="dark">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="pc-loader">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ Header ] start -->
    <header class="pc-header">
        <?= $this->insert('partials/header') ?>
    </header>
    <!-- [ Header ] end -->

    <!-- [ Sidebar ] start -->
    <nav class="pc-sidebar">
        <?= $this->insert('partials/sidebar') ?>
    </nav>
    <!-- [ Sidebar ] end -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-sm-auto">
                            <div class="page-header-title">
                                <h5 class="mb-0"><?= $this->e($title) ?></h5>
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../navigation/index.html"><i
                                            class="ph-duotone ph-house"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= $this->e($title) ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <?= $this->section('content') ?>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- [ Footer ] start -->
    <footer class="pc-footer">
        <?= $this->insert('partials/footer') ?>
    </footer>
    <!-- [ Footer ] end -->

    <!-- [ Config ] start -->
    <?= $this->insert('partials/config') ?>
    <!-- [ Config ] end -->



    <!-- Required Js -->
    <script src="<?= getenv('APP_URL') ?>/assets/js/plugins/popper.min.js"></script>
    <script src="<?= getenv('APP_URL') ?>/assets/js/plugins/jquery.min.js"></script>
    <script src="<?= getenv('APP_URL') ?>/assets/js/plugins/simplebar.min.js"></script>
    <script src="<?= getenv('APP_URL') ?>/assets/js/plugins/bootstrap.min.js"></script>
    <script src="<?= getenv('APP_URL') ?>/assets/js/fonts/custom-font.js"></script>
    <script src="<?= getenv('APP_URL') ?>/assets/js/pcoded.js"></script>
    <script src="<?= getenv('APP_URL') ?>/assets/js/plugins/feather.min.js"></script>
    <?php if (!empty($_SESSION['flash_toast'])): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: 'toast-top-center',
                    timeOut: 10000
                };
                toastr[<?= json_encode($_SESSION['flash_toast']['type']) ?>](
                    <?= json_encode($_SESSION['flash_toast']['message']) ?>
                );
            });
        </script>
        <?php unset($_SESSION['flash_toast']); ?>
    <?php endif; ?>
    <!-- [Page Specific JS] end -->
    <?= $this->section('scripts') ?>
    <!-- [Page Specific JS] end -->

    <script>
        feather.replace();
        layout_rtl_change('false');
        layout_caption_change('true');
        layout_change('light');
        change_box_container('false');
        layout_caption_change('true');
        layout_rtl_change('false');
        preset_change("preset-1");
        layout_change('light');
        layout_sidebar_change('dark');
        layout_header_change('dark');
        change_box_container('false');
        layout_caption_change('true');
        layout_rtl_change('false');
        preset_change("preset-1");
    </script>

</body>

</html>