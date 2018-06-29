<?php
	session_start();
	include_once("../global/banco.php");
	
	$inMatr = $inNome = $inMail = $inTele = $inObs = null;
	
	$inMatr = $_POST['inMatr'];
	$inNome = $_POST['inNome'];
	$inMail = $_POST['inMail'];
	$inAti = $_POST['inAti'];
//TELEFONE
	$inTele = $_POST['inTele'];
//OBSERVAÇÃO
	$inObs = $_POST['inObs'];
		
//VERIFICAR SE OS CAMPOS ESTÃO PREENCHIDOS
	if ($inNome == '' /*OR $inTele ==  ''*/){
		$msg = "Preencha todos os campos obrigatórios";
		header("Location: ../instrutores.php?m=$msg");
		exit;
	};
//INCLUSÃO EM USUÁRIO
	
	$inpessoa = mysqli_prepare ($conexao,"UPDATE usuario SET nome = ?, email = ?, ativo = ?, obs = ? WHERE matricula = ? ");
		mysqli_stmt_bind_param($inpessoa,'ssisi', $inNome, $inMail, $inAti, $inObs, $inMatr);

#	$intelefone = mysqli_prepare ($conexao,"INSERT INTO telefone VALUES (?,?)");
#		mysqli_stmt_bind_param($intelefone,'is', $inMatr, $inTele);
		
	mysqli_stmt_execute($inpessoa);	
#	mysqli_stmt_execute($intelefone);
	
//FECHAR CONEXÃO	
	mysqli_stmt_close($inpessoa);
#	mysqli_stmt_close($intelefone);
	mysqli_close($conexao);
	
	if($inpessoa /*AND $intelefone*/){
	$msg = "Alterações Efetuadas";
	header("Location: ../instrutores.php?m=$msg");
		exit;
	}
	
	if (!mysqli_query($conexao, $inpessoa) /*OR !mysqli_query($conexao, $intelefone)*/) {
    printf("Errormessage: %s\n", mysqli_error($link));
	exit;
	}
?>