<?php
	session_start();
	include_once("../global/banco.php");
	
	$geMatr = $geNome = $geMail = $geTele = $geObs = null;
	
	$geMatr = $_POST['geMatr'];
	$geNome = $_POST['geNome'];
	$geMail = $_POST['geMail'];
	$geAti = $_POST['geAti'];
//TELEFONE
	$geTele = $_POST['geTele'];
//OBSERVAÇÃO
	$geObs = $_POST['geObs'];
		
//VERIFICAR SE OS CAMPOS ESTÃO PREENCHIDOS
	if ($geNome == '' /*OR $geTele ==  ''*/){
		$msg = "Preencha todos os campos obrigatórios";
		header("Location: ../gerentes.php?m=$msg");
		exit;
	};
//INCLUSÃO EM USUÁRIO
	
	$gepessoa = mysqli_prepare ($conexao,"UPDATE usuario SET nome = ?, email = ?, ativo = ?, obs = ? WHERE matricula = ? ");
		mysqli_stmt_bind_param($gepessoa,'ssisi', $geNome, $geMail, $geAti, $geObs, $geMatr);

#	$getelefone = mysqli_prepare ($conexao,"INSERT INTO telefone VALUES (?,?)");
#		mysqli_stmt_bind_param($getelefone,'is', $geMatr, $geTele);
		
	mysqli_stmt_execute($gepessoa);	
#	mysqli_stmt_execute($getelefone);
	
//FECHAR CONEXÃO	
	mysqli_stmt_close($gepessoa);
#	mysqli_stmt_close($getelefone);
	mysqli_close($conexao);
	
	if($gepessoa /*AND $getelefone*/){
	$msg = "Alterações Efetuadas";
	header("Location: ../gerentes.php?m=$msg");
		exit;
	}
	
	if (!mysqli_query($conexao, $gepessoa) /*OR !mysqli_query($conexao, $getelefone)*/) {
    printf("Errormessage: %s\n", mysqli_error($link));
	exit;
	}
?>


