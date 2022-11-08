<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Mural</title>
    <link rel="icon" href="" type="image/x-icon"/>
    <link rel="stylesheet" href="<?=BASE; ?>assets/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="<?=BASE; ?>assets/css/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?=BASE; ?>assets/dataTable/dataTable.css">
    <script type="text/javascript" src="<?=BASE; ?>assets/js/jquery.min.js"></script>
    <link rel="stylesheet/less" type="text/css" href="<?=BASE; ?>assets/css/styles.less" />
</head>
<body>

<div class="loading">
  <div class="loader"></div>
</div>

<!-- menu -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="<?=BASE; ?>">
        <span class="ef">Meu</span> Mural 
        <i class="fas fa-pencil-alt"></i>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <!-- <ul class="nav navbar-nav">
        <li><a href="#">Home</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
      </ul> -->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?=BASE; ?>">Home</a></li>
        <li><a href="<?=BASE; ?>home/login">Login</a></li>
      </ul>
    </div>
  </div>
</nav>


<!-- Conteudos -->
<div class="container">
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>   
</div>

<!-- AQUI COLOCAREMOS O FOOTER -->
<script src="<?=BASE; ?>assets/js/bootstrap.min.js"></script>
<script src="<?=BASE; ?>assets/js/jquery.mask.js"></script>
<script src="<?=BASE; ?>assets/dataTable/dataTable.js"></script>
<script src="<?=BASE; ?>assets/js/config.js"></script>
<script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
<script src="<?=BASE; ?>assets/js/scripts.js"></script>

</body>
</html>
