<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mural do Romance</title>
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
      <a class="navbar-brand" href="<?=(!empty($_SESSION['cLogin']))?BASE.'admin':BASE ?>">
        <span class="ef">Mural</span> do Romance 
        <i class="fas fa-pencil-alt"></i>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <?php if(!empty($_SESSION['cLogin'])): ?>
          <li>
            <a href="<?=BASE; ?>mural">
              <i class="fas fa-pencil-alt"></i> Mural
            </a>
          </li>
          <li>
            <a href="<?=BASE; ?>guidance">
              <i class="fas fa-genderless"></i> Orientação
            </a>
          </li>
          <li>
            <a href="<?=BASE; ?>interest">
              <i class="fas fa-transgender"></i> Interesse
            </a>
          </li>
          <li>
            <a href="<?=BASE; ?>admin/logout" title="Sair">
              <i class="fas fa-sign-out-alt"></i>
            </a>
          </li>
        <?php else: ?>
          <li><a href="<?=BASE; ?>">Home</a></li>
          <li><a href="#mural">Ver Mural</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>


<!-- Conteudos -->
<div class="container">
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>   
</div>

<?php if(empty($_SESSION['cLogin'])): ?>
  <div class="config container">
    <a href="<?=BASE; ?>home/login" class="link">
      <i class="fas fa-ellipsis-h"></i>
    </a>
  </div>
<?php endif; ?>

<!-- AQUI COLOCAREMOS O FOOTER -->
<script src="<?=BASE; ?>assets/js/bootstrap.min.js"></script>
<script src="<?=BASE; ?>assets/js/jquery.mask.js"></script>
<script src="<?=BASE; ?>assets/dataTable/dataTable.js"></script>
<script src="<?=BASE; ?>assets/js/config.js"></script>
<script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
<script src="<?=BASE; ?>assets/js/scripts.js"></script>

</body>
</html>
