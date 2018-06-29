<?php
	session_start();
	include_once("../global/banco.php");
			
	$alCpf = $_POST['alCpf'];
	$alCpf = preg_replace("/[^0-9]/","", $alCpf);
	
//VERIFICA CPF JÁ CADASTRADO	
	$ccpf = mysqli_prepare ($conexao,"SELECT cpf FROM aluno WHERE cpf = ?");
	mysqli_stmt_bind_param($ccpf,'s', $alCpf);
	
	mysqli_stmt_execute($ccpf);	
	mysqli_stmt_bind_result($ccpf, $compCpf);
	mysqli_stmt_fetch($ccpf);
	
	mysqli_stmt_close($ccpf);
		
	if (!($compCpf == null)){
		$msg = "CPF já cadastrado";
		header("Location: ../alunos.php?m=$msg");
		exit;
	}
/////////////////////////////

	$alMatr = $_POST['alMatr'];
	$alNome = $_POST['alNome'];
	$alSexo = $_POST['alSexo'];
	$alMail = $_POST['alMail'];
	$alInst = $_POST['alInst'];
//TELEFONE
	$alTele = $_POST['alTele'];
	$alTele = preg_replace("/[^0-9]/","", $alTele);
//ENDEREÇO
	$alEnde = $_POST['alEnde'];
	$alNume = $_POST['alNume'];
	$alComp = $_POST['alComp'];
	$alCida = $_POST['alCida'];
	$alCep = $_POST['alCep'];
	$alCep = preg_replace("/[^0-9]/","", $alCep);
	$alEsta = $_POST['alEsta'];
//OBSERVAÇÃO
	$alObs = $_POST['alObs'];
		
//VERIFICAR SE OS CAMPOS ESTÃO PREENCHIDOS
	if ($alCpf == '' OR $alNome == '' OR $alSexo == '' OR $alTele == '' OR $alEnde == '' OR $alNume == '' OR $alCida == '' OR $alEsta == ''){
		$msg = "Preencha todos os campos obrigatórios";
		header("Location: ../alunos.php?m=$msg");
		exit;
	};
//INCLUSÃO EM USUÁRIO
		
	$alpessoa = mysqli_prepare ($conexao,"INSERT INTO usuario VALUES (?,?,?,1,'ef28af523accaf45868d3db38d421c41',1,9,?)");
		mysqli_stmt_bind_param($alpessoa,'isss', $alMatr, $alNome, $alMail, $alObs);
	
	$alaluno = mysqli_prepare ($conexao,"INSERT INTO aluno VALUES (?,?,?,?)");
		mysqli_stmt_bind_param($alaluno,'issi', $alMatr, $alCpf, $alSexo, $alInst);
	
	$altelefone = mysqli_prepare ($conexao,"INSERT INTO telefone VALUES (?,?)");
		mysqli_stmt_bind_param($altelefone,'is', $alMatr, $alTele);
	
	$alendereco = mysqli_prepare ($conexao,"INSERT INTO endereco VALUES (?,?,?,?,?,?,?)");
		mysqli_stmt_bind_param($alendereco,'issssss', $alMatr, $alEnde, $alNume, $alCida, $alCep, $alEsta, $alComp);
		
	mysqli_stmt_execute($alpessoa);	
	mysqli_stmt_execute($alaluno);	
	mysqli_stmt_execute($altelefone);	
	mysqli_stmt_execute($alendereco);	

	
//FECHAR CONEXÃO	
	mysqli_stmt_close($alpessoa);
	mysqli_stmt_close($alaluno);
	mysqli_stmt_close($altelefone);
	mysqli_stmt_close($alendereco);
	mysqli_close($conexao);
	
	if($alpessoa AND $alaluno AND $altelefone AND $alendereco){
	$msg = "Registro Efetuado";
	header("Location: ../alunos.php?m=$msg");
		exit;
	}
	
	if (!mysqli_query($conexao, $alpessoa) OR !mysqli_query($conexao, $alaluno) OR !mysqli_query($conexao, $altelefone) OR !mysqli_query($conexao, $alendereco)) {
    printf("Errormessage: %s\n", mysqli_error($link));
	exit;
	}
	
?>