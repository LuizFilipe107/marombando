<?php
// 1. VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	session_start();
	
	if($_SESSION['NSENHA'] == 0){
		header("Location: ../principal.php");
		exit;
	};
	
	$nsenha = null; 
	$ncsenha = null;
	
	$nsenha = $_POST['nsenha'];
	$ncsenha = $_POST['ncsenha'];
	
	if ($nsenha == '' OR $ncsenha == ''){
		$msg = "Preencha todos os campos";
		header("Location: ../novasenha.php?m=$msg");
		exit;
	};
	
	if ($nsenha == $ncsenha){
		$nsenha = md5($nsenha);
	}else{
		$msg = "Senhas não conferem";
		header("Location: ../novasenha.php?m=$msg");
		exit;
	};
	
// BANCO DE DADOS
	include_once("../global/banco.php");
	
	$nSen = mysqli_prepare ($conexao, "UPDATE usuario SET senha = ?, novasenha = 0 WHERE matricula = ?");
	mysqli_stmt_bind_param($nSen,'si',$nsenha, $_SESSION['MATRICULA']);
	
	mysqli_stmt_execute($nSen);

	if(mysqli_stmt_execute($nSen)){
		mysqli_stmt_close($nSen);
		mysqli_close($conexao);
		session_destroy();
		$msg = "Senha alterada com sucesso";
		header("Location: ../index.php?m=$msg");
		exit;
	}else{
		mysqli_stmt_close($nSen);
		mysqli_close($conexao);
		session_destroy();
		header("Location: ../index.php?m=$msg");
		printf("Errormessage: %s\n", mysqli_error($link));
		exit;
	}
?>