<?php
	//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	session_start();
	session_destroy();
	$msg = "Acesso encerrado";
	header("Location: ../index.php?m=$msg");
	exit;
?>
