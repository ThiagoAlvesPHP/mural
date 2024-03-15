<section class="mural-admin">
    <h1 class="title"><i class="fas fa-pencil-alt"></i> Mural</h1>
    <hr>

    <div class="row">
        <div class="col-sm-4">
            <form class="row" action="<?= BASE; ?>mural/actions" method="GET">
                <div class="col-sm-9">
                    <input type="text" style="height: 45px;" class="form-control" name="delete_ids" require placeholder="Exemplo: 1,2,3 (Colocar os IDs)">
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-danger btn-lg btn-block">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-sm-4">
            <a href="<?= BASE; ?>mural/actions?delete_all=true" class="btn btn-danger btn-lg btn-block">Deletar Todos <i class="fas fa-trash-alt"></i></a>
        </div>
        <div class="col-sm-4">
            <a href="<?= BASE; ?>mural/print" target="_blank" class="btn btn-default btn-lg btn-block">Gerar Imagem Mural Atual <i class="fas fa-images"></i></a>
        </div>
    </div>

    <h3>Mural Atual <small>(Ultimos 07 dias)</small></h3>

    <?php if (!empty($_SESSION['alert'])) : ?>
        <div class="alert alert-<?= $_SESSION['alert']['class'] ?>">
            <?= $_SESSION['alert']['message']; ?>
        </div>
    <?php unset($_SESSION['alert']);
    endif; ?>

    <!-- inicio lista mural atual -->
    <?php if (!empty($listApproved)) : ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 250px;">Ação</th>
                        <th>Foto</th>
                        <th>Foto Ativa</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Cidade</th>
                        <th>Whatsapp</th>
                        <th>Idade</th>
                        <th>Orientação</th>
                        <th>Interesse</th>
                        <th>Cor</th>
                        <th>Modo Infinintum</th>
                        <th>ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listApproved as $value) : ?>
                        <tr>
                            <td style="width: 250px;">
                                <a href="<?= BASE; ?>mural/find/<?= $value['id']; ?>" title="Ver" class="btn btn-success">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= BASE; ?>mural/actions?is_infinite=<?= $value['is_infinite']; ?>&id=<?= $value['id']; ?>" title="Modo Infinito" class="btn btn-primary">
                                    <i class="fas fa-infinity"></i>
                                </a>
                                <a href="<?= BASE; ?>mural/actions?is_old=<?= $value['is_old']; ?>&id=<?= $value['id']; ?>" title="Migrar para CA" class="btn btn-warning">
                                    <i class="fas fa-angle-double-down"></i>
                                </a>
                                <a href="<?= BASE; ?>mural/actions?block=<?= $value['id']; ?>" title="Bloquear E-mail | IP" class="btn btn-default">
                                    <i class="fas fa-user-lock"></i>
                                </a>
                                <a href="<?= BASE; ?>mural/actions?del=<?= $value['id']; ?>" title="Deletar" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <td>
                                <img src="<?= (isset($value['photo']) && file_exists($value['photo'])) ? BASE . $value['photo'] : BASE . 'assets/img/user-default.webp' ?>" width="30px" height="30px" alt="<?= $value['name']; ?>" data-toggle="modal" data-target="#modal<?= $value['id']; ?>">

                                <div class="modal fade" id="modal<?= $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="modalLabelSmall">Foto: de <?= $value['name']; ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <img src="<?= (isset($value['photo']) && file_exists($value['photo'])) ? BASE . $value['photo'] : BASE . 'assets/img/user-default.webp' ?>" width="100%" alt="<?= $value['name']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select name="" class="photo_valid">
                                    <option value="1" <?= $value['photo_valid'] ? "selected" : ""; ?>>Ativo</option>
                                    <option value="0" <?= $value['photo_valid'] ? "" : "selected"; ?>>Inativo</option>
                                </select>

                                <input type="hidden" name="" class="id" value="<?= $value['id'] ?>">
                            </td>
                            <td><?= $value['name']; ?></td>
                            <td><?= $value['email']; ?></td>
                            <td><?= $value['city']; ?></td>
                            <td><?= $value['whatsapp']; ?></td>
                            <td><?= $value['age']; ?></td>
                            <td><?= $value['guidance']; ?></td>
                            <td><?= $value['interest']; ?></td>
                            <td><input type="color" value="<?= $value['color']; ?>" disabled></td>
                            <td><?= $value['is_infinite'] ? "Ativo" : "Inativo"; ?></td>
                            <td><?= $value['id']; ?></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="alert alert-info">
            Nenhum registro encontrado!
        </div>
    <?php endif; ?>
    <!-- fim de lista mural atual -->

    <!-- inicio lista classificados antigos -->
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <h3>Classificados Antigos</h3>
        </div>
        <div class="col-sm-6">
            <a href="<?= BASE; ?>mural/print?is_old=true" class="btn btn-default btn-lg btn-block" target="
              _blank">
                <i class="fas fa-images"></i> Gerar Imagem CA
            </a>
        </div>
    </div>
    <?php if (!empty($listOld)) : ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 250px;">Ação</th>
                        <th>Foto</th>
                        <th>Foto Ativa</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Cidade</th>
                        <th>Whatsapp</th>
                        <th>Idade</th>
                        <th>Orientação</th>
                        <th>Interesse</th>
                        <th>Cor</th>
                        <th>Modo Infinintum</th>
                        <th>ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listOld as $value) : ?>
                        <tr>
                            <td>
                                <a href="<?= BASE; ?>mural/find/<?= $value['id']; ?>" title="Ver" class="btn btn-success">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= BASE; ?>mural/actions?is_infinite=<?= $value['is_infinite']; ?>&id=<?= $value['id']; ?>" title="Modo Infinito" class="btn btn-primary">
                                    <i class="fas fa-infinity"></i>
                                </a>
                                <a href="<?= BASE; ?>mural/actions?is_old=<?= $value['is_old']; ?>&id=<?= $value['id']; ?>" title="Migrar para CA" class="btn btn-warning">
                                    <i class="fas fa-angle-double-up"></i>
                                </a>
                                <a href="<?= BASE; ?>mural/actions?block=<?= $value['id']; ?>" title="Bloquear E-mail | IP" class="btn btn-default">
                                    <i class="fas fa-user-lock"></i>
                                </a>
                                <a href="<?= BASE; ?>mural/actions?del=<?= $value['id']; ?>" title="Deletar" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <td>
                                <img src="<?= (isset($value['photo']) && file_exists($value['photo'])) ? BASE . $value['photo'] : BASE . 'assets/img/user-default.webp' ?>" width="30px" height="30px" alt="<?= $value['name']; ?>" data-toggle="modal" data-target="#modal<?= $value['id']; ?>">

                                <div class="modal fade" id="modal<?= $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="modalLabelSmall">Foto: de <?= $value['name']; ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <img src="<?= (isset($value['photo']) && file_exists($value['photo'])) ? BASE . $value['photo'] : BASE . 'assets/img/user-default.webp' ?>" width="100%" alt="<?= $value['name']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select name="" class="photo_valid">
                                    <option value="1" <?= $value['photo_valid'] ? "selected" : ""; ?>>Ativo</option>
                                    <option value="0" <?= $value['photo_valid'] ? "" : "selected"; ?>>Inativo</option>
                                </select>

                                <input type="hidden" name="" class="id" value="<?= $value['id'] ?>">
                            </td>
                            <td><?= $value['name']; ?></td>
                            <td><?= $value['email']; ?></td>
                            <td><?= $value['city']; ?></td>
                            <td><?= $value['whatsapp']; ?></td>
                            <td><?= $value['age']; ?></td>
                            <td><?= $value['guidance']; ?></td>
                            <td><?= $value['interest']; ?></td>
                            <td><input type="color" value="<?= $value['color']; ?>" disabled></td>
                            <td><?= $value['is_infinite'] ? "Ativo" : "Inativo"; ?></td>
                            <td><?= $value['id']; ?></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="alert alert-info">
            Nenhum registro encontrado!
        </div>
    <?php endif; ?>
    <!-- fim de lista classificados antigos -->

    <!-- inicio lista mural pendentes -->
    <h3>Classificados Pendentes</h3>

    <?php if (!empty($listPending)) : ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 250px;">Ação</th>
                        <th>Foto</th>
                        <th>Foto Ativa</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Cidade</th>
                        <th>Whatsapp</th>
                        <th>Idade</th>
                        <th>Orientação</th>
                        <th>Interesse</th>
                        <th>Cor</th>
                        <th>Modo Infinintum</th>
                        <th>ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listPending as $value) : ?>
                        <tr>
                            <td>
                                <a href="<?= BASE; ?>mural/find/<?= $value['id']; ?>" title="Ver" class="btn btn-success">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= BASE; ?>mural/actions?is_infinite=<?= $value['is_infinite']; ?>&id=<?= $value['id']; ?>" title="Modo Infinito" class="btn btn-primary">
                                    <i class="fas fa-infinity"></i>
                                </a>
                                <a href="<?= BASE; ?>mural/actions?block=<?= $value['id']; ?>" title="Bloquear E-mail | IP" class="btn btn-default">
                                    <i class="fas fa-user-lock"></i>
                                </a>
                                <a href="<?= BASE; ?>mural/actions?del=<?= $value['id']; ?>" title="Deletar" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a>

                                <a href="<?= BASE; ?>mural/actions?approved=<?= $value['id']; ?>" title="Aprovar" class="btn btn-info">
                                    <i class="far fa-thumbs-up"></i>
                                </a>

                            </td>
                            <td>
                                <img src="<?= (isset($value['photo']) && file_exists($value['photo'])) ? BASE . $value['photo'] : BASE . 'assets/img/user-default.webp' ?>" width="30px" height="30px" alt="<?= $value['name']; ?>" data-toggle="modal" data-target="#modal<?= $value['id']; ?>">

                                <div class="modal fade" id="modal<?= $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="modalLabelSmall">Foto: de <?= $value['name']; ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <img src="<?= (isset($value['photo']) && file_exists($value['photo'])) ? BASE . $value['photo'] : BASE . 'assets/img/user-default.webp' ?>" width="100%" alt="<?= $value['name']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select name="" class="photo_valid">
                                    <option value="1" <?= $value['photo_valid'] ? "selected" : ""; ?>>Ativo</option>
                                    <option value="0" <?= $value['photo_valid'] ? "" : "selected"; ?>>Inativo</option>
                                </select>

                                <input type="hidden" name="" class="id" value="<?= $value['id'] ?>">
                            </td>
                            <td><?= $value['name']; ?></td>
                            <td><?= $value['email']; ?></td>
                            <td><?= $value['city']; ?></td>
                            <td><?= $value['whatsapp']; ?></td>
                            <td><?= $value['age']; ?></td>
                            <td><?= $value['guidance']; ?></td>
                            <td><?= $value['interest']; ?></td>
                            <td><input type="color" value="<?= $value['color']; ?>" disabled></td>
                            <td><?= $value['is_infinite'] ? "Ativo" : "Inativo"; ?></td>
                            <td><?= $value['id']; ?></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="alert alert-info">
            Nenhum registro encontrado!
        </div>
    <?php endif; ?>
    <!-- fim de lista mural atual -->

</section>

<script src="<?= BASE . 'assets/js/admin/mural.js'; ?>"></script>