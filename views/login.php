<section class="login">
    <h1 class="title">Login</h1>
    <hr>

    <div class="img-effect-kiss">
        <div class="imgs-kiss">
            <!-- <div class="lb">
                <img src="<?=BASE; ?>assets/img/labios.png" alt="Kiss" width="100%" class="pulse img-primary">
            </div> -->
            <div class="lb">
                <img src="<?=BASE; ?>assets/img/quadro1.png" alt="Quadro" width="100%" class="img-secondy">
            </div>
        </div>

        <div class="jovens">
            <img src="<?=BASE; ?>assets/img/casal-hetero.png" alt="Jovens" width="100%" class="img">
            <img src="<?=BASE; ?>assets/img/casal-gay.png" alt="Jovens" width="100%" class="img">
            <img src="<?=BASE; ?>assets/img/casal-gay2.png" alt="Jovens" width="100%" class="img">
        </div>
    </div>

    <form  action="<?=BASE; ?>home/actionLogin" method="POST">
        <?php if($error): ?>
            <div class="alert alert-danger">
                <strong>Alerta!</strong>
                <span class="text">E-mail e/ou Senha incorretos.</span>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" name="email" value="<?=($error)?$data->email:''; ?>" class="form-control" id="email" required>
        </div>
        <div class="form-group">
            <label for="pass">Senha:</label>
            <input type="password" name="pass" value="<?=($error)?$data->pass:''; ?>" class="form-control" id="pass" required>
        </div>
        <button type="submit" class="btn btn-success btn-block btn-lg">Fazer Login</button>
    </form>
</section>