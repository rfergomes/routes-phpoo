<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Flat Able is trending dashboard template made using Bootstrap 5 design framework. Flat Able is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
    <meta name="keywords"
        content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
    <meta name="author" content="phoenixcoded">
    <title><?= $this->e($title) ?></title>
    <!-- [Favicon] icon -->
    <link rel="icon" href="<?= getenv('APP_URL') ?>/assets/images/favicon.svg" type="image/x-icon">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        text-align: center;
        padding: 50px;
    }

    h1 {
        color: #e74c3c;
    }

    p {
        font-size: 18px;
    }

    @media (max-width: 600px) {
        body {
            padding: 20px;
        }

        h1 {
            font-size: 24px;
        }

        p {
            font-size: 16px;
        }
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <i class="fas fa-tools fa-5x"></i>
    <br>
    <h1>Site em Manutenção</h1>
    <p><?= $_ENV['APP_MAINTENANCE_MESSAGE'] ?></p>
    </body>

</html>