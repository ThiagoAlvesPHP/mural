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