<section class="mural-find-admin">
    <h1 class="title"><i class="fas fa-pencil-alt"></i> Mural</h1>
    <hr>

    <?php if ($success) : ?>
        <div class="alert alert-success">
            <span class="text">Publicação altorizada com sucesso.</span>
        </div>
    <?php endif; ?>

    <form id="form">
        <h4>ID: <?= $find['id']; ?></h4>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <label for="name">Nome:</label>
                    <input type="text" value="<?= $find['name']; ?>" class="form-control" id="name" readonly disabled>
                </div>
                <div class="col-sm-4">
                    <label for="email">E-mail:</label>
                    <input type="email" value="<?= $find['email']; ?>" class="form-control" id="email" readonly disabled>
                </div>
                <div class="col-sm-4">
                    <label for="city">Cidade:</label>
                    <input type="city" value="<?= $find['city']; ?>" class="form-control" id="city" readonly disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label for="whatsapp">Whatsapp:</label>
                    <input type="text" value="<?= $find['whatsapp']; ?>" class="form-control" id="whatsapp" readonly disabled>
                </div>
                <div class="col-sm-4">
                    <label for="age">Idade:</label>
                    <input type="number" value="<?= $find['age']; ?>" class="form-control" id="age" readonly disabled>
                </div>
                <div class="col-sm-4">
                    <label for="is_infinite">Modo Inifinito:</label>
                    <input type="text" value="<?= $find['is_infinite'] ? "Ativo" : "Inativo"; ?>" class="form-control" id="is_infinite" readonly disabled>
                </div>
            </div>
        </div>
        <div class="form-group guidances">
            <p class="title">Orientação</p>
            <div class="group-radios">
                <label class="radio-inline active">
                    <span><?= $find['guidance'] ?></span>
                </label>
            </div>
        </div>
        <div class="form-group interests">
            <p class="title">Interesse</p>
            <div class="group-radios">
                <label class="radio-inline active">
                    <span><?= $find['interest'] ?></span>
                </label>
            </div>
        </div>

        <div id="result">
            <div class="alert" style="background-color: <?= $find['color']; ?>;">
                <span><?= $find['message']; ?></span>
            </div>
        </div>

        <div class="form-group">
            <div class="row complement">
                <div class="col-sm-6">
                    <label for="complement">Complemento <small>(Opcional)</small></label>
                </div>
            </div>

            <?php if (!empty($find['complement'])) : ?>
                <textarea name="complement" id="complement" cols="30" rows="10" class="form-control"><?= $find['complement']; ?></textarea>
            <?php else : ?>
                <div class="alert alert-warning">
                    Nenhum complemento registrado!
                </div>
            <?php endif; ?>
        </div>
    </form>

</section>