<section class="mural-admin">
    <h1 class="title"><i class="fas fa-pencil-alt"></i> Mural</h1>
    <hr>

    <div class="row">
        <div class="col-sm-12 text-right">
            <a href="<?=BASE; ?>mural/print" target="_blank" class="btn btn-default btn-lg">Gerar Imagem <i class="fas fa-images"></i></a>
        </div>
    </div>

    <h3>Publicações Aprovadas</h3>

    <?php if($delete): ?>
        <div class="alert alert-danger">
            <span class="text">Publicação deletada com sucesso.</span>
        </div>
    <?php endif; ?>
    <?php if($approved): ?>
        <div class="alert alert-success">
            <span class="text">Publicação altorizada com sucesso.</span>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="100">Ação</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Whatsapp</th>
                    <th>Idade</th>
                    <th>Orientação</th>
                    <th>Interesse</th>
                    <th>Cor</th>
                </tr>
            </thead>
            <?php if(!empty($listApproved)): ?>
                <tbody>
                    <?php foreach ($listApproved as $value): ?>
                        
                        <tr>
                            <td>
                                <a href="<?=BASE; ?>mural/find/<?=$value['id']; ?>" class="btn btn-success">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?=BASE; ?>mural/actions?del=<?=$value['id']; ?>&redirect=true" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <td><?=$value['name']; ?></td>
                            <td><?=$value['email']; ?></td>
                            <td><?=$value['whatsapp']; ?></td>
                            <td><?=$value['age']; ?></td>
                            <td><?=$value['guidance']; ?></td>
                            <td><?=$value['interest']; ?></td>
                            <td><input type="color" value="<?=$value['color']; ?>" disabled></td>
                        </tr>
                        
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
        </table>
    </div>
</section>