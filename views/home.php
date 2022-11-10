<section class="home">
    <h1 class="title">Meu Mural <i class="fas fa-pencil-alt"></i></h1>
    <hr>

    <form action="<?=BASE; ?>" method="POST">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" id="name">
                </div>
                <div class="col-sm-6">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="whatsapp">Whatsapp:</label>
                    <input type="text" name="whatsapp" class="form-control" id="whatsapp">
                </div>
                <div class="col-sm-6">
                    <label for="age">Idade:</label>
                    <input type="number" name="age" class="form-control" id="age">
                </div>
            </div>
        </div>
        <div class="form-group guidances">
            <p class="title">Orientação</p>
            <div class="group-radios">
                <?php if(!empty($guidances)): ?>
                    <?php foreach ($guidances as $value): ?>
                        <label class="radio-inline">
                            <input type="radio" name="guidance" id="guidances<?=$value['id'] ?>" value="<?=$value['title'] ?>">
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
                            <input type="radio" name="interest" id="interests<?=$value['id'] ?>" value="<?=$value['title'] ?>">
                            <span><?=$value['title'] ?></span>
                        </label>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group colors">
            <p class="title">Cor da Publicação</p>
            <div class="group-radios">
                <?php if(!empty($colors)): ?>
                    <?php foreach ($colors as $key => $value): ?>
                        <label class="radio-inline">
                            <input type="radio" name="color" value="<?=$key; ?>">
                            <i class="fas fa-star" style="color: <?=$value['color'] ?>;"></i>
                        </label>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

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

        <button type="submit" class="btn btn-success btn-block btn-lg">
            <span>Publicar</span>
        </button>
    </form>
</section>