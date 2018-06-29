<?php
	session_start();//inicializando a sessao
	
	if($_SESSION['LOGADO'] == TRUE){
	}else{
		$msg = "Sessão expirada";
		header("Location: index.php?m=$msg");
		exit;
	}
?>