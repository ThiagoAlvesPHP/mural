<?php
class Creates extends model{
	//create modal bootstrap 3 e fontawesome
	public function createModal($array){
		ob_start();
		?>
			<button class="btn <?=$array['typeBtn']; ?> <?=$array['fontawesome']; ?>" title="<?=$array['titleBtn']; ?>" data-toggle="modal" data-target="#<?=$array['idAttr']; ?>"></button>

			<div id="<?=$array['idAttr']; ?>" class="modal fade" role="dialog">
				<div class="modal-dialog <?=$array['widthModal']; ?>">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><?=$array['title']; ?></h4>
						</div>
						<div class="modal-body">
							<?=$array['content']; ?>
						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
						</div>
					</div>
				</div>
			</div>
		<?php
		$modal = ob_get_contents();
    	ob_end_clean();

		return $modal;
	}
}