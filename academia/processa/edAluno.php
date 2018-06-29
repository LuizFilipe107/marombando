<?php
	session_start();
	include_once("../global/banco.php");
	
	$alCpf = null; 	$alMatr = null;	$alNome = null;	$alSexo = null;
	$alMail = null;	$alInst = null; $alAtiv = null;	$alTele = null;	
	$alEnde = null;	$alNume = null;	$alComp = null;	$alCida = null;	
	$alCep = null;	$alEsta = null;	$alObs = null;
	
	$alCpf = $_POST['alCpf'];
	
//VERIFICA CPF JÁ CADASTRADO	
/*	$ccpf = mysqli_prepare ($conexao,"SELECT cpf FROM aluno WHERE cpf = ?");
	mysqli_stmt_bind_param($ccpf,'s', $alCpf);
	
	mysqli_stmt_execute($ccpf);
	mysqli_stmt_bind_result($ccpf, $compCpf);
	mysqli_stmt_fetch($ccpf);
	
	mysqli_stmt_close($ccpf);
		
	if (!($compCpf == null)){
		$msg = "CPF já cadastrado";
		header("Location: ../alunos.php?m=$msg");
		exit;
	}*/
/////////////////////////////

	$alMatr = $_POST['alMatr'];
	$alNome = $_POST['alNome'];
	$alSexo = $_POST['alSexo'];
	$alMail = $_POST['alMail'];
	$alInst = $_POST['alInst'];
	$alAti = $_POST['alAti'];
//TELEFONE
	$alTele = $_POST['alTele'];
//ENDEREÇO
	$alEnde = $_POST['alEnde'];
	$alNume = $_POST['alNume'];
	$alComp = $_POST['alComp'];
	$alCida = $_POST['alCida'];
	$alCep = $_POST['alCep'];
	$alEsta = $_POST['alEsta'];
//OBSERVAÇÃO
	$alObs = $_POST['alObs'];
		
//VERIFICAR SE OS CAMPOS ESTÃO PREENCHIDOS
	if ($alCpf == '' OR $alNome == '' OR $alSexo == '' /*OR $alTele == ''*/ OR $alEnde == '' OR $alNume == '' OR $alCida == '' OR $alEsta == ''){
		$msg = "Preencha todos os campos obrigatórios";
		header("Location: ../alunos.php?m=$msg");
		exit;
	};
//INCLUSÃO EM USUÁRIO
		
	$alpessoa = mysqli_prepare ($conexao,"UPDATE usuario SET nome = ?, email = ?, ativo = ?, obs = ? WHERE matricula = ? ");
		mysqli_stmt_bind_param($alpessoa,'ssisi', $alNome, $alMail, $alAti, $alObs, $alMatr);
	
	$alaluno = mysqli_prepare ($conexao,"UPDATE aluno SET cpf = ?, sexo = ?, instrutor = ? WHERE mtuser = ? ");
		mysqli_stmt_bind_param($alaluno,'ssii', $alCpf, $alSexo, $alInst, $alMatr);
	
#	$altelefone = mysqli_prepare ($conexao,"INSERT INTO telefone VALUES (?,?) ");
#		mysqli_stmt_bind_param($altelefone,'is', $alMatr, $alTele);
	
	$alendereco = mysqli_prepare ($conexao,"UPDATE endereco SET endereco = ?, numero = ?, cidade = ?, CEP = ?, estado = ?, complemento = ? WHERE mtuser = ? ");
		mysqli_stmt_bind_param($alendereco,'ssssssi', $alEnde, $alNume, $alCida, $alCep, $alEsta, $alComp, $alMatr);
		
	mysqli_stmt_execute($alpessoa);	
	mysqli_stmt_execute($alaluno);	
#	mysqli_stmt_execute($altelefone);	
	mysqli_stmt_execute($alendereco);	

	
//FECHAR CONEXÃO	
	mysqli_stmt_close($alpessoa);
	mysqli_stmt_close($alaluno);
#	mysqli_stmt_close($altelefone);
	mysqli_stmt_close($alendereco);
	mysqli_close($conexao);
	
	if($alpessoa AND $alaluno /*AND $altelefone*/ AND $alendereco){
	$msg = "Alterações Efetuadas";
	header("Location: ../alunos.php?m=$msg");
		exit;
	}
	
	if (!mysqli_query($conexao, $alpessoa) OR !mysqli_query($conexao, $alaluno) /*OR !mysqli_query($conexao, $altelefone)*/ OR !mysqli_query($conexao, $alendereco)) {
    printf("Errormessage: %s\n", mysqli_error($link));
	exit;
	}
	
?>