<section class="home">
    <h1 class="title">Meu Mural <i class="fas fa-pencil-alt"></i></h1>
    <hr>

    <form action="<?=BASE; ?>" method="POST">
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" name="name" class="form-control" id="name">
            <label for="email">E-mail:</label>
            <input type="email" name="email" class="form-control" id="email">
            <label for="whatsapp">Whatsapp:</label>
            <input type="text" name="whatsapp" class="form-control" id="whatsapp">
            <label for="age">Idade:</label>
            <input type="number" name="age" class="form-control" id="age">
        </div>

        <div class="form-group">
            <label for="complement">Complemento <small>(Opcional)</small></label>
            <textarea name="complement" id="complement" cols="30" rows="10" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</section>