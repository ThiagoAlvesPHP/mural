<section class="home">
    <h1 class="title">Mural do Romance <i class="fas fa-pencil-alt"></i></h1>
    <h3 class="sub-title">Seu Classificado de Relacionamentos</h3>
    <h2 class="pulse text-center">Publique Agora</h2>
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

    <?php if($success): ?>
        <div class="alert <?=(!empty($_GET['status']))?'alert-warning':'alert-success'; ?> alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <span class="text">
                <?=(!empty($_GET['status']))?'Sua mensagem esta em processo de aprovação. Aguarde!':'Sua mensagem foi puclicada com sucesso! - Em 07 dias ela será excluída!'; ?>
            </span>
        </div>
    <?php endif; ?>

    <form action="<?=BASE; ?>home/register" method="POST" id="form">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="col-sm-6">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="whatsapp">Whatsapp:</label>
                    <input type="text" name="whatsapp" class="form-control" id="whatsapp" required>
                </div>
                <div class="col-sm-6">
                    <label for="age">Idade:</label>
                    <input type="number" name="age" class="form-control" id="age" required>
                </div>
            </div>
        </div>
        <div class="form-group guidances">
            <p class="title">Orientação</p>
            <div class="group-radios">
                <?php if(!empty($guidances)): ?>
                    <?php foreach ($guidances as $value): ?>
                        <label class="radio-inline">
                            <input type="radio" name="guidance" id="guidances<?=$value['id'] ?>" value="<?=$value['title'] ?>" required>
                            <span><?=$value['title'] ?></span>
                        </label>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group interests">
            <p class="title">Interesse</p>
            <div class="group-radios">
                <?php if(!empty($interests)): ?>
                    <?php foreach ($interests as $value): ?>
                        <label class="radio-inline">
                            <input type="radio" name="interest" id="interests<?=$value['id'] ?>" value="<?=$value['title'] ?>" required>
                            <span><?=$value['title'] ?></span>
                        </label>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group colors">
            <p class="title">Cor da Publicação</p>
            <div class="error"></div>
            <div class="group-radios">
                <?php if(!empty($colors)): ?>
                    <?php foreach ($colors as $key => $value): ?>
                        <label class="radio-inline">
                            <input type="radio" name="color" value="<?=$key; ?>" required>
                            <i class="fas fa-star" style="color: <?=$value['color'] ?>;"></i>
                        </label>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div id="result"></div>

        <div class="form-group">
            <div class="row complement">
                <div class="col-sm-6">
                    <label for="complement">Complemento <small>(Opcional)</small></label>
                </div>
                <div class="col-sm-6" data-toggle="collapse" data-target="#demo">
                    <span>Abrir Complemento</span> <i class="fas fa-chevron-down"></i>
                </div>
            </div>
            
            <div id="demo" class="collapse">
                <textarea name="complement" id="complement" cols="30" rows="10" class="form-control"></textarea>
            </div>
        </div>

        <button type="submit" disabled class="btn btn-success btn-block btn-lg">
            <span>Publicar</span>
        </button>
    </form>

    <hr>

    <div class="well" id="mural">
        <div class="form-group guidances">
            <p class="title">Mural</p>
        </div>

        <?php if(!empty($listApproved)): ?>
            <?php foreach ($listApproved as $value): ?>
                <div class="alert" style="background-color: <?=$value['color']; ?>;">
                    <span><?=$value['message']; ?> <?=$value['complement']; ?></span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>