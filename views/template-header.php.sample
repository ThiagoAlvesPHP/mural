<?php
$list = (new Banner())->listActive();
?>
<header class="container header">
    <div class="row">
        <div class="col-sm-4">
            <h3 class="title">Mural do Romance <i class="fas fa-pencil-alt"></i></h3>
            <div class="logo">
                <img src="<?= BASE; ?>assets/img/quadro1.png" alt="Quadro" width="100%" class="logo">
            </div>
        </div>
        <div class="col-sm-8">
            <?php if (!empty($list)) : ?>
                <div class="header-carousel">
                    <?php foreach ($list as $key => $value) : ?>
                        <div class="item-banner" style="background-image: url('<?= $value['image']; ?>');">
                            <p class="title">
                                <?= $value['title']; ?>
                            </p>
                            <p class="text">
                                <?= $value['text']; ?>
                            </p>
                            <a href="<?= $value['link']; ?>" target="_blank" class="btn btn-info link">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="alert alert-warning">
                    Nenhum registro encontrado!
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>

<script>
    $(document).ready(function() {
        $('.header-carousel').slick();
    });
</script>
<?php ?>