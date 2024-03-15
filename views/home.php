<section class="home">
    <?php if (!empty($signs)) : ?>
        <div class="signs">
            <marquee class="content" behavior="scroll" direction="left" scrollamount="10" loop="infinite">
                <?php foreach ($signs as $value) : $division = (count($signs) > 1) ? ' - ' : ''; ?>
                    <span class="text"><?= $value['text'] . $division; ?></span>
                <?php endforeach; ?>
            </marquee>
        </div>
    <?php endif; ?>

    <div class="republish">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary button-action" data-toggle="modal" data-target="#modal_republicar">
            Republicar
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modal_republicar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="modalLabelSmall">Republicar</h4>
                    </div>
                    <form action="" class="form-action">
                        <div class="modal-body">
                            <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Republicar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h1 class="title">Mural do Romance <i class="fas fa-pencil-alt"></i></h1>
    <h3 class="sub-title">Seu Classificado de Relacionamentos</h3>
    <h2 class="pulse text-center">Publique Agora</h2>
    <hr>

    <?php require 'components/img-effects.php'; ?>

    <?php if (!empty($_SESSION['alert'])) : ?>
        <div class="alert alert-<?= $_SESSION['alert']['class'] ?> alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?= $_SESSION['alert']['message']; ?>
        </div>
    <?php unset($_SESSION['alert']);
    endif; ?>

    <form action="<?= BASE; ?>home/register" method="POST" id="form" enctype="multipart/form-data">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" value="<?= (!empty($find)) ? $find['name'] : ""; ?>" id="name" required>
                </div>
                <div class="col-sm-6">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" class="form-control" value="<?= (!empty($find)) ? $find['email'] : ""; ?>" id="email" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="city">Cidade:</label>
                    <input type="city" name="city" class="form-control" value="<?= (!empty($find)) ? $find['city'] : ""; ?>" id="city" required>
                </div>
                <div class="col-sm-6">
                    <label for="whatsapp">Telefone/Whatsapp:</label>
                    <input type="text" name="whatsapp" class="form-control" id="whatsapp" value="<?= (!empty($find)) ? $find['whatsapp'] : ""; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="group-form">
                        <label for="age">Idade:</label>
                        <small>Caso tenha alguma idade no campo abaixo a opção "OU" não será considerada</small>
                        <input type="number" min="14" name="age" class="form-control" value="<?= (!empty($find)) ? $find['age'] : ""; ?>" id="age">

                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">OU</span>

                        <select name="age_text" id="age_text" class="form-control">
                            <option value="" selected>Selecione outra opção no lugar de IDADE</option>
                            <option>α - sou novinho(a)</option>
                            <option>z - sou Jovem</option>
                            <option>y - sou Adulto</option>
                            <option>x - sou Maduro(a)</option>
                            <option>Baby boomers - sou Senhor(a)</option>
                        </select>
                    </div>

                </div>
                <div class="col-sm-6">
                    <label for="photo">Foto: <small>('png', 'jpg', 'jpeg')</small></label>
                    <input type="file" name="photo" class="form-control" id="photo">
                </div>
            </div>
        </div>
        <div class="form-group guidances">
            <p class="title">Orientação</p>
            <div class="group-radios">
                <?php if (!empty($guidances)) : ?>
                    <?php foreach ($guidances as $value) : ?>
                        <label class="radio-inline <?= (!empty($find) && $find['guidance_id'] == $value['id']) ? "active" : ""; ?>">
                            <input type="radio" <?= (!empty($find) && $find['guidance_id'] == $value['id']) ? "checked" : ""; ?> name="guidance" id="guidances<?= $value['id'] ?>" value="<?= $value['id'] . ":" . $value['title']; ?>" required>
                            <span><?= $value['title'] ?></span>
                        </label>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group guidances interests-primary">
            <p class="title">Perfil para Relacionamento</p>
            <div class="group-radios">
                <?php if (!empty($interests_primary)) : ?>
                    <?php foreach ($interests_primary as $value) : ?>
                        <label class="radio-inline <?= (!empty($find) && $find['interest_primary_id'] == $value['id']) ? "active" : ""; ?>">
                            <input type="radio" <?= (!empty($find) && $find['interest_primary_id'] == $value['id']) ? "checked" : ""; ?> name="interest_primary" id="interests_primary<?= $value['id'] ?>" value="<?= $value['id'] . ":" . $value['name']; ?>" required>
                            <span><?= $value['name'] ?></span>
                        </label>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group interests">
            <p class="title">Interesse</p>
            <div class="group-radios">
                <?php if (!empty($interests)) : ?>
                    <?php foreach ($interests as $value) : ?>
                        <label class="radio-inline interests-primary-select<?= $value['interest_primary_id']; ?> <?= (!empty($find) && $find['interest_id'] == $value['id']) ? "active" : ""; ?>">
                            <input type="radio" <?= (!empty($find) && $find['interest_id'] == $value['id']) ? "checked" : ""; ?> name="interest" id="interests<?= $value['id'] ?>" value="<?= $value['id'] . ":" . $value['title']; ?>" required>
                            <span><?= $value['title'] ?></span>
                        </label>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group colors">
            <p class="title">Cor da Publicação</p>
            <div class="error"></div>
            <div class="group-radios">
                <?php if (!empty($colors)) : ?>
                    <?php foreach ($colors as $key => $value) : ?>
                        <label class="radio-inline <?= (!empty($find) && $find['color'] == $value['color']) ? "active" : ""; ?>">
                            <input type="radio" name="color" <?= (!empty($find) && $find['color'] == $value['color']) ? "checked" : ""; ?> value="<?= $key; ?>" required>
                            <i class="fas fa-star" style="color: <?= $value['color'] ?>;"></i>
                        </label>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div id="result">
            <?php if (!empty($find)) : ?>
                <div class="alert alert-info">
                    <span style="color: <?= $find['color']; ?>;">
                        <?= $find['message']; ?>
                    </span>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <div class="row complement" style="<?= (!empty($find)) ? "display: block;" : ""; ?>">
                <div class="col-sm-6">
                    <label for="complement">Complemente se preferir <small>(Opcional)</small></label>
                </div>
                <div class="col-sm-6" data-toggle="collapse" data-target="#demo">
                    <span>Abrir Complemento</span> <i class="fas fa-chevron-down"></i>
                </div>
            </div>

            <div id="demo" class="collapse">
                <textarea name="complement" id="complement" cols="30" rows="10" class="form-control"></textarea>
            </div>
        </div>

        <button type="submit" <?= (!empty($find)) ? "" : "disabled"; ?> class="btn btn-success btn-block btn-lg">
            <span>Publicar</span>
        </button>
    </form>

    <hr>

    <!-- mural atual -->
    <section class="well" id="mural">
        <div class="form-group guidances">
            <p class="title">Mural Atual</p>
        </div>

        <?php if (!empty($listApproved)) : ?>
            <?php foreach ($listApproved as $value) : ?>
                <div class="alert" style="background-color: <?= $value['color']; ?>;">
                    <img src="<?= ($value['photo_valid'] && isset($value['photo']) && file_exists($value['photo'])) ? BASE . $value['photo'] : BASE . 'assets/img/user-default.webp' ?>" class="user-photo" alt="<?= $value['name']; ?>" data-toggle="modal" data-target="#modal<?= $value['id']; ?>">

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
                                    <img src="<?= ($value['photo_valid'] && file_exists($value['photo'])) ? BASE . $value['photo'] : BASE . 'assets/img/user-default.webp' ?>" width="100%" alt="<?= $value['name']; ?>" data-toggle="modal" data-target="#modal<?= $value['id']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <span><?= $value['message']; ?> <?= $value['complement']; ?></span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>

    <section class="header">
        <?php if (!empty($banners)) : ?>
            <div class="header-carousel">
                <?php foreach ($banners as $key => $value) : ?>
                    <div class="item-banner" style="background-image: url('<?= $value['image']; ?>');">
                        <p class="title">
                            <?= $value['title']; ?>
                        </p>
                        <p class="text">
                            <?= $value['text']; ?>
                        </p>
                        <a href="<?= $value['link']; ?>" target="_blank" class="btn btn-info link">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-warning">
                Nenhum registro de banner encontrado!
            </div>
        <?php endif; ?>


        <script>
            $(document).ready(function() {
                $('.header-carousel').slick({
                    infinite: true,
                    speed: 300
                });
            });
        </script>
    </section>

    <!-- cassifiados antigos -->
    <section class="well" id="ca">
        <div class="form-group guidances">
            <p class="title">Classificados Antigos</p>
        </div>

        <?php if (!empty($listOld)) : ?>
            <?php foreach ($listOld as $value) : ?>
                <div class="alert list-old" style="background-color: <?= $value['color']; ?>;">
                    <img src="<?= ($value['photo_valid'] && isset($value['photo']) && file_exists($value['photo'])) ? BASE . $value['photo'] : BASE . 'assets/img/user-default.webp' ?>" class="user-photo" alt="<?= $value['name']; ?>" data-toggle="modal" data-target="#modal<?= $value['id']; ?>">

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
                                    <img src="<?= ($value['photo_valid'] && file_exists($value['photo'])) ? BASE . $value['photo'] : BASE . 'assets/img/user-default.webp' ?>" width="100%" alt="<?= $value['name']; ?>" data-toggle="modal" data-target="#modal<?= $value['id']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <span><?= $value['message']; ?> <?= $value['complement']; ?></span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</section>

<script src="<?= BASE . 'assets/js/pages/republish.js'; ?>"></script>