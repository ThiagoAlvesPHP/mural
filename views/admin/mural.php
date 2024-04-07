<section class="mural-admin">
    <h1 class="title"><i class="fas fa-pencil-alt"></i> Publicações</h1>
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
    <?php require "./views/admin/lists-mural/listApproved.php"; ?>

    <!-- inicio lista classificados antigos -->
    <hr>
    <!-- inicio ca -->
    <?php require "./views/admin/lists-mural/listOld.php"; ?>

    <!-- inicio lista mural pendentes -->
    <?php require "./views/admin/lists-mural/listPending.php"; ?>

    <!-- inicio publicações arquivadas -->
    <?php require "./views/admin/lists-mural/listModeThird.php"; ?>

</section>

<script src="<?= BASE . 'assets/js/admin/mural.js'; ?>"></script>