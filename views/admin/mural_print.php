<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Mural</title>
    <link rel="stylesheet" href="<?= BASE; ?>assets/css/bootstrap.css" type="text/css" />
    <script type="text/javascript" src="<?= BASE; ?>assets/js/jquery.min.js"></script>
    <link rel="stylesheet/less" type="text/css" href="<?= BASE; ?>assets/css/styles.less" />
</head>

<body>

    <section class="print-mural container">
        <div class="alert alert-info" id="copy-image" data-clipboard-target="#foo">
            <span>Copie a imagem abaixo e cole onde desejar!</span>
        </div>

        <div id="result">
            <?php if (!empty($listApproved)) : ?>
                <?php foreach ($listApproved as $value) : ?>
                    <div class="alert" style="background-color: <?= $value['color']; ?>;">
                        <img src="<?= ($value['photo_valid'] && isset($value['photo']) && file_exists($value['photo'])) ? BASE . $value['photo'] : BASE . 'assets/img/user-default.webp' ?>" class="user-photo" alt="<?= $value['name']; ?>" data-toggle="modal" data-target="#modal<?= $value['id']; ?>">
                        <span><?= $value['message']; ?> <?= $value['complement']; ?></span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- AQUI COLOCAREMOS O FOOTER -->
    <script src="<?= BASE; ?>assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/less@4.1.1"></script>
    <script src="<?= BASE; ?>assets/js/html2canvas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
    </script>

    <script>
        $(document).ready(function() {
            setTimeout(() => {
                takeshot();
            }, 500);

            function takeshot() {
                let div = document.getElementById('result');

                html2canvas(div).then(
                    function(canvas) {
                        let img = `<img width='100%' id="foo" src="${canvas.toDataURL()}">`;

                        // console.log(canvas.toDataURL());

                        $(div).html(`${img}`);
                    })
            }
        });
    </script>
</body>

</html>