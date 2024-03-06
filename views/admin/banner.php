<section class="banner-admin">
    <h1 class="title"><i class="fas fa-banner"></i> Banner</h1>
    <hr>

    <?php if (!empty($_SESSION['alert'])) : ?>
        <div class="alert alert-<?= $_SESSION['alert']['class'] ?>">
            <?= $_SESSION['alert']['message']; ?>
        </div>
    <?php unset($_SESSION['alert']);
    endif; ?>

    <div class="row">
        <div class="col-sm-6">
            <form action="<?= BASE; ?>banner/actions" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" class="form-control" id="title" required>
                </div>
                <div class="form-group">
                    <label for="image">Imagem <small>(jpg, png) - Tamanho Indicado: 840px X 225px</small></label>
                    <input type="file" name="image" class="form-control" id="image" required>
                </div>
                <div class="form-group">
                    <label for="text">Texto</label>
                    <input type="text" name="text" class="form-control" id="text" required>
                </div>
                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" name="link" class="form-control" id="link" required>
                </div>

                <button type="submit" name="set" value="1" class="btn btn-success btn-block btn-lg">Registrar</button>
            </form>
        </div>
        <div class="col-sm-6">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Ação</th>
                            <th>Titulo</th>
                            <th>Imagem</th>
                            <th>Link</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <?php if (!empty($list)) : ?>
                        <?php foreach ($list as $value) : ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="<?= BASE; ?>banner/actions?del=<?= $value['id']; ?>" class="btn btn-danger">
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
                                                        <form action="<?= BASE; ?>banner/actions" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="id" value="<?= $value['id']; ?>">
                                                            <div class="form-group">
                                                                <label for="title">Título</label>
                                                                <input type="text" name="title" value="<?= $value['title'] ?>" class="form-control" id="title" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="image">Imagem <small>(jpg, png)</small></label>
                                                                <input type="file" name="image" class="form-control" id="image">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="text">Texto</label>
                                                                <input type="text" name="text" value="<?= $value['text'] ?>" class="form-control" id="text" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="link">Link</label>
                                                                <input type="text" name="link" value="<?= $value['link'] ?>" class="form-control" id="link" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="is_active">Status</label>
                                                                <select name="is_active" class="form-control" id="is_active">
                                                                    <option value="1" <?= $value['is_active'] ? "selected" : ""; ?>>Ativo</option>
                                                                    <option value="0" <?= $value['is_active'] ? "" : "selected"; ?>>Inativo</option>
                                                                </select>
                                                            </div>

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
                                    <td><?= $value['title']; ?></td>
                                    <td>
                                        <img src="<?= $value['image']; ?>" width="30" alt="">
                                    </td>
                                    <td><?= $value['link']; ?></td>
                                    <td><?= $value['is_active'] ? "Ativo" : "Inativo"; ?></td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</section>