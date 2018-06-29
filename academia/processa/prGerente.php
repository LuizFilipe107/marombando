<?php
	session_start();
	
	$geMatr = $_POST['geMatr'];
	$geNome = $_POST['geNome'];
	$geMail = $_POST['geMail'];
//TELEFONE
	$geTele = $_POST['geTele'];
	$geTele = preg_replace("/[^0-9]/","", $geTele);
//OBSERVAÇÃO
	$geObs = $_POST['geObs'];
		
//VERIFICAR SE OS CAMPOS ESTÃO PREENCHIDOS
	if ($geNome == '' OR $geTele == ''){
		$msg = "Preencha todos os campos obrigatórios";
		header("Location: ../gerentes.php?m=$msg");
		exit;
	};
//INCLUSÃO EM USUÁRIO
	include_once("../global/banco.php");
	
	$gepessoa = mysqli_prepare ($conexao,"INSERT INTO usuario VALUES (?,?,?,1,'ef28af523accaf45868d3db38d421c41',1,2,?)");
		mysqli_stmt_bind_param($gepessoa,'isss', $geMatr, $geNome, $geMail, $geObs);

	$getelefone = mysqli_prepare ($conexao,"INSERT INTO telefone VALUES (?,?)");
		mysqli_stmt_bind_param($getelefone,'is', $geMatr, $geTele);
		
	mysqli_stmt_execute($gepessoa);	
	mysqli_stmt_execute($getelefone);
	
//FECHAR CONEXÃO	
	mysqli_stmt_close($gepessoa);
	mysqli_stmt_close($getelefone);
	mysqli_close($conexao);
	
	if($gepessoa AND $getelefone){
	$msg = "Registro Efetuado ";
	header("Location: ../gerentes.php?m=$msg");
		exit;
	}
	
	if (!mysqli_query($conexao, $gepessoa) OR !mysqli_query($conexao, $getelefone)) {
    printf("Errormessage: %s\n", mysqli_error($link));
	exit;
	}
?>