<?php
	ob_start();

	require "./block-html.php";

	$html = ob_get_contents();
	ob_end_clean();
	if (!empty($_GET['block'])) {
		
		//bloquear
		if ($_GET['block'] == 'block') {
			//abro o arquivo index.php
			$index = fopen('index.php', 'w');
			//reescrevo no arquivo index
			fwrite($index, $html);
			//encerro a aplicação
			fclose($index);
		}
		//liberar
		if ($_GET['block'] == 'libery') {
			//leio o arquivo index.php
			$file = file_get_contents('index_backup.php');
			//abro o arquivo index_backup.php
			$backup = fopen('index.php', 'w');
			//escrevo as informações do arquivo index.php em index_backup.php
			fwrite($backup, $file);
			//encerro a aplicação
			fclose($backup);
		}
	}

	//deletar tudo
	if (!empty($_GET['delete'])) {
		delTree('./view');
		delTree('./model');
		delTree('./controller');
		delTree('./core');
		delTree('./assets');
		//abro o arquivo index.php
		$index = fopen('index.php', 'w');
		//reescrevo no arquivo index
		fwrite($index, $html);
		//encerro a aplicação
		fclose($index);
	}

	function delTree($dir) { 
		$files = array_diff(scandir($dir), array('.','..')); 
		foreach ($files as $file) { 
			(is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
		} 
		return rmdir($dir); 
	}