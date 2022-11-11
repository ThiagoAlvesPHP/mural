<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Mural</title>
    <link rel="stylesheet" href="<?=BASE; ?>assets/css/bootstrap.css" type="text/css" />
    <script type="text/javascript" src="<?=BASE; ?>assets/js/jquery.min.js"></script>
    <link rel="stylesheet/less" type="text/css" href="<?=BASE; ?>assets/css/styles.less" />
</head>
<body>

    <section class="print-mural container">
        <div id="result">
            <?php if(!empty($listApproved)): ?>
                <?php foreach ($listApproved as $value): ?>
                    <div class="alert" style="background-color: <?=$value['color']; ?>;">
                        <span><?=$value['message']; ?></span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- AQUI COLOCAREMOS O FOOTER -->
    <script src="<?=BASE; ?>assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
    <script src="<?=BASE; ?>assets/js/html2canvas.js"></script>
  </script>

    <script>
		$(document).ready(function()
		{

            setTimeout(() => {
                takeshot();
            }, 500);

            function takeshot() {
                let div = document.getElementById('result');

                html2canvas(div).then(
                    function (canvas) {
                        let img = `<img width='100%' src="${canvas.toDataURL()}">`;
                        $(div).html(`${img}`);
                    })
            }

		});	
	</script>
</body>
</html>