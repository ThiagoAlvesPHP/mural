<section class="interest-admin">
    <h1 class="title"><i class="fas fa-transgender"></i> Interesse</h1>
    <hr>

    <?php if (!empty($_SESSION['alert'])) : ?>
        <div class="alert alert-<?= $_SESSION['alert']['class'] ?>">
            <?= $_SESSION['alert']['message']; ?>
        </div>
    <?php unset($_SESSION['alert']);
    endif; ?>

    <div class="row">
        <div class="col-sm-6">
            <h3>Perfil Relacionamento</h3>
            <form action="<?= BASE; ?>interest/actions" method="POST">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>

                <button type="submit" name="set_<?= InterestPrimary::TABLE; ?>" value="1" class="btn btn-success btn-block btn-lg">Registrar</button>
            </form>
            <hr>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Ação</th>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <?php if (!empty($interest_primary)) : ?>
                        <?php foreach ($interest_primary as $value) : ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal<?= InterestPrimary::TABLE; ?><?= $value['id']; ?>">
                                            <i class="far fa-edit"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div id="modal<?= InterestPrimary::TABLE; ?><?= $value['id']; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Editar</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= BASE; ?>interest/actions" method="POST">
                                                            <div class="form-group">
                                                                <label for="name">Título</label>
                                                                <input type="text" name="name" class="form-control" value="<?= $value['name'] ?>" id="name" required>
                                                            </div>
                                                            <input type="hidden" name="id" value="<?= $value['id']; ?>">
                                                            <button type="submit" name="up_<?= InterestPrimary::TABLE; ?>" value="1" class="btn btn-success btn-block btn-lg">Atualizar</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $value['name']; ?></td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        <div class="col-sm-6">
            <h3>Interesse</h3>
            <form action="<?= BASE; ?>interest/actions" method="POST">
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" class="form-control" id="title" required>
                </div>
                <div class="form-group">
                    <label for="interest_primary_id">Perfil Relacionamento</label>
                    <select name="interest_primary_id" id="interest_primary_id" class="form-control">
                        <?php foreach ($interest_primary as $value) : ?>
                            <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" name="set" value="1" class="btn btn-success btn-block btn-lg">Registrar</button>
            </form>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Ação</th>
                            <th>Perfil</th>
                            <th>Interesse</th>
                        </tr>
                    </thead>
                    <?php if (!empty($interest)) : ?>
                        <?php foreach ($interest as $value) : ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="<?= BASE; ?>interest/actions?del=<?= $value['id']; ?>" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal<?= $value['id']; ?>">
                                            <i class="far fa-edit"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div id="modal<?= $value['id']; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Editar</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= BASE; ?>interest/actions" method="POST">
                                                            <div class="form-group">
                                                                <label for="title">Título</label>
                                                                <input type="text" name="title" class="form-control" value="<?= $value['title'] ?>" id="title" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="interest_primary_id">Perfil Relacionamento</label>
                                                                <select name="interest_primary_id" id="interest_primary_id" class="form-control">
                                                                    <?php foreach ($interest_primary as $item) : ?>
                                                                        <option <?= ($item['id'] == $value['interest_primary_id']) ? "selected" : ""; ?> value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <input type="hidden" name="id" value="<?= $value['id']; ?>">

                                                            <button type="submit" name="up" value="1" class="btn btn-success btn-block btn-lg">Atualizar</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $value['name']; ?></td>
                                    <td><?= $value['title']; ?></td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</section>