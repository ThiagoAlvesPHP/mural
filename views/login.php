<section class="login">
    <h1 class="title">Login</h1>
    <hr>

    <form  action="<?=BASE; ?>" method="POST">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" name="email" class="form-control" id="email">
        </div>
        <div class="form-group">
            <label for="pass">Senha:</label>
            <input type="password" name="pass" class="form-control" id="pass">
        </div>
        <button type="submit" class="btn btn-success btn-block btn-lg">Fazer Login</button>
    </form>
</section>