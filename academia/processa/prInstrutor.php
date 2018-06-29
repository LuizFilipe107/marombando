<?php
	session_start();
	
	$inMatr = $_POST['inMatr'];
	$inNome = $_POST['inNome'];
	$inMail = $_POST['inMail'];
//TELEFONE
	$inTele = $_POST['inTele'];
	$inTele = preg_replace("/[^0-9]/","", $inTele);
//OBSERVAÇÃO
	$inObs = $_POST['inObs'];
		
//VERIFICAR SE OS CAMPOS ESTÃO PREENCHIDOS
	if ($inNome == '' OR $inTele == ''){
		$msg = "Preencha todos os campos";
		header("Location: ../instrutores.php?m=$msg");
		exit;
	};
//INCLUSÃO EM USUÁRIO
	include_once("../global/banco.php");
	
	$inpessoa = mysqli_prepare ($conexao,"INSERT INTO usuario VALUES (?,?,?,1,'ef28af523accaf45868d3db38d421c41',1,3,?)");
		mysqli_stmt_bind_param($inpessoa,'isss', $inMatr, $inNome, $inMail, $inObs);

	$intelefone = mysqli_prepare ($conexao,"INSERT INTO telefone VALUES (?,?)");
		mysqli_stmt_bind_param($intelefone,'is', $inMatr, $inTele);
		
	mysqli_stmt_execute($inpessoa);	
	mysqli_stmt_execute($intelefone);
	
//FECHAR CONEXÃO	
	mysqli_stmt_close($inpessoa);
	mysqli_stmt_close($intelefone);
	mysqli_close($conexao);
	
	if($inpessoa AND $intelefone){
	$msg = "Registro Efetuado ";
	header("Location: ../instrutores.php?m=$msg");
		exit;
	}
	
	if (!mysqli_query($conexao, $inpessoa) OR !mysqli_query($conexao, $intelefone)) {
    printf("Errormessage: %s\n", mysqli_error($link));
	exit;
	}
?>