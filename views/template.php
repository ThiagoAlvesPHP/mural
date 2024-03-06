<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mural do Romance</title>
    <link rel="icon" href="<?= BASE; ?>" type="image/x-icon" />
    <link rel="stylesheet" href="<?= BASE; ?>assets/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="<?= BASE; ?>assets/css/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE; ?>assets/dataTable/dataTable.css">
    <script type="text/javascript" src="<?= BASE; ?>assets/js/jquery.min.js"></script>
    <link rel="stylesheet/less" type="text/css" href="<?= BASE; ?>assets/css/styles.less" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- loading -->
    <div class="loading">
        <div class="loader"></div>
    </div>

    <!-- header -->
    <?php require "./views/template-header.php"; ?>

    <!-- menu -->
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= (!empty($_SESSION['cLogin'])) ? BASE . 'admin' : BASE ?>">
                    <span class="ef">Mural</span> do Romance
                    <i class="fas fa-pencil-alt"></i>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <?php if (!empty($_SESSION['cLogin'])) : ?>
                        <li>
                            <a href="<?= BASE; ?>mural">
                                <i class="fas fa-pencil-alt"></i> Mural
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE; ?>guidance">
                                <i class="fas fa-genderless"></i> Orientação
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE; ?>interest">
                                <i class="fas fa-transgender"></i> Interesse
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE; ?>sign">
                                <i class="fas fa-text-width"></i> Letreiro
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE; ?>banner">
                                <i class="far fa-images"></i> Banner
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE; ?>admin/logout" title="Sair">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </li>
                    <?php else : ?>
                        <li><a href="<?= BASE; ?>">Home</a></li>
                        <li><a href="#mural">Mural Atual</a></li>
                        <li><a href="#ca">Classificados Antigos</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteudos -->
    <div class="container container-primary">
        <?php $this->loadViewInTemplate($viewName, $viewData); ?>
    </div>

    <div class="config container">
        <div>
            <a href="mailto:muraldoromance@gmail.com">muraldoromance@gmail.com</a>
        </div>
        <div class="points">
            ..............................................................................
            <a href="<?= BASE; ?>home/login" class="link">
                .
            </a>
        </div>
    </div>

    <!-- AQUI COLOCAREMOS O FOOTER -->
    <script src="<?= BASE; ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= BASE; ?>assets/js/jquery.mask.js"></script>
    <script src="<?= BASE; ?>assets/dataTable/dataTable.js"></script>
    <script src="<?= BASE; ?>assets/js/config.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/less@4.1.1"></script>
    <script src="<?= BASE; ?>assets/js/scripts.js"></script>
</body>

</html>