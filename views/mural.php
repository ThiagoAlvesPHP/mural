<section class="home">
    <h1 class="title">Mural do Romance <i class="fas fa-pencil-alt"></i></h1>
    <h3 class="sub-title">Seu Classificado de Relacionamentos</h3>
    <hr>

    <div class="img-effect-kiss">
        <div class="imgs-kiss">
            <!-- <div class="lb">
                <img src="<?=BASE; ?>assets/img/labios.png" alt="Kiss" width="100%" class="pulse img-primary">
            </div> -->
            <div class="lb">
                <img src="<?=BASE; ?>assets/img/quadro1.png" alt="Quadro" width="100%" class="img-secondy pulse">
            </div>
        </div>

        <div class="jovens">
            <img src="<?=BASE; ?>assets/img/casal-hetero.png" alt="Jovens" width="100%" class="img">
            <img src="<?=BASE; ?>assets/img/casal-gay.png" alt="Jovens" width="100%" class="img">
            <img src="<?=BASE; ?>assets/img/casal-gay2.png" alt="Jovens" width="100%" class="img">
        </div>
    </div>

    <div class="well">
        <?php if(!empty($listApproved)): ?>
            <?php foreach ($listApproved as $value): ?>
                <div class="alert" style="background-color: <?=$value['color']; ?>;">
                    <span><?=$value['message']; ?></span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>