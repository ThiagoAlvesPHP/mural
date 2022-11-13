<section class="home-admin">
    <h1 class="title"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
    <hr>

    <div class="row">
        <div class="col-sm-6">
            <a href="<?=BASE ?>mural" class="btn btn-info btn-block btn-lg">
                <span>Mural</span> 
                <i class="fas fa-pencil-alt"></i>
            </a>

            <div class="row mode">
                <div class="col-sm-6">
                    <a href="<?=BASE; ?>admin/mode/<?=$user['mode']; ?>" class="btn btn-<?=(!$user['mode'])?'success':'danger' ?> btn-lg btn-block"><span>Modo <?=($user['mode'])?'Automático':'Manual' ?></span></a>
                </div>
                <div class="col-sm-6 text">
                    <div class="alert text-center">
                        Modo <span><?=(!$user['mode'])?'Automático':'Manual' ?></span> Ligado <i class="far fa-lightbulb"></i>
                    </div>
                </div>
            </div>

            <h3>Infomativo</h3>
            <div class="alert alert-warning">
                <i class="fas fa-trash-alt"></i>
                <span>Limpeza automática de publicações de 07 dias para trás</span>
            </div>
        </div>
        <div class="col-sm-6">
            <h3>Publicações Pendentes</h3>

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
                            <th>Complemento</th>
                        </tr>
                    </thead>
                    <?php if(!empty($listPending)): ?>
                        <tbody>
                            <?php foreach ($listPending as $value): ?>
                                
                                <tr>
                                    <td>
                                        <a href="<?=BASE; ?>mural/actions?del=<?=$value['id']; ?>" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <a href="<?=BASE; ?>mural/actions?approved=<?=$value['id']; ?>" class="btn btn-success">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    </td>
                                    <td><?=$value['complement']; ?></td>
                                </tr>
                                
                            <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</section>