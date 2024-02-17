<section class="sign">
    <h1 class="title"><i class="fas fa-text-width"></i> Letreiro</h1>
    <hr>

    <div class="row">
        <div class="col-sm-6">
            <?php if ($success) : ?>
                <div class="alert alert-success">
                    <strong>Parabéns!</strong>
                    <span class="text">
                        <?php if ($up) : ?>
                            Título alterado com sucesso.
                        <?php else : ?>
                            Título registrado com sucesso.
                        <?php endif; ?>
                    </span>
                </div>
            <?php endif; ?>

            <?php if ($delete) : ?>
                <div class="alert alert-danger">
                    <strong>Parabéns!</strong>
                    <span class="text">Título deletado com sucesso.</span>
                </div>
            <?php endif; ?>

            <form action="<?= BASE; ?>sign/actions" method="POST">
                <div class="form-group">
                    <label for="text">Texto</label>
                    <input type="text" name="text" class="form-control" id="text" required>
                </div>

                <button type="submit" name="set" value="1" class="btn btn-success btn-block btn-lg">Registrar</button>
            </form>
        </div>
        <div class="col-sm-6">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="100px">Ação</th>
                            <th>Texto</th>
                        </tr>
                    </thead>
                    <?php if (!empty($list)) : ?>
                        <?php foreach ($list as $value) : ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="<?= BASE; ?>sign/actions?del=<?= $value['id']; ?>" class="btn btn-danger">
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
                                                        <form action="<?= BASE; ?>sign/actions" method="POST">
                                                            <div class="form-group">
                                                                <label for="text">Text</label>
                                                                <input type="text" name="text" class="form-control" value="<?= $value['text'] ?>" id="text" required>
                                                            </div>
                                                            <input type="hidden" name="id" value="<?= $value['id']; ?>">
                                                            <button type="submit" name="up" value="1" class="btn btn-success btn-block btn-lg">Registrar</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $value['text']; ?></td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</section>