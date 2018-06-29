<?php
// 1. RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	
	$senha = md5($senha);

// 2. VERIFICAR SE OS CAMPOS ESTÃO PREENCIDOS
	if ($login == '' OR $senha == ''){
		$msg = "Preencha todos os campos";
		header("Location: ../index.php?m=$msg");
		exit;
	};

// 3. VALIDAR USUÁRIO E SENHA CADASTRADO
	
	if (!(substr($login,'0',1)=='1' or substr($login,'0',1)=='2' or substr($login,'0',1)=='3' or substr($login,'0',1)=='9')){
		$msg = "Login Inválido";
		header("Location: ../index.php?m=$msg");
		exit;
	}
	
	//3.3 CRIAR O SCRIPT SQL
	include_once("../global/banco.php");
		
	$stmt = mysqli_prepare($conexao,"SELECT matricula, nome, ativo, senha, novasenha, nivel FROM usuario WHERE matricula = ?");
		mysqli_stmt_bind_param($stmt,'i',$login);
		
	mysqli_stmt_execute($stmt);	
	mysqli_stmt_bind_result($stmt, $mat, $nome, $atv, $senhacad, $nsenha, $nivel);
	mysqli_stmt_fetch($stmt);
	
	if($login == $mat AND $senha == $senhacad){
		if($atv == 0){
			$msg = "Conta desativada. Contate um administrador";
			header("Location: ../index.php?m=$msg");
			exit;
		}
		
		session_start();
		
		$_SESSION['LOGADO'] = TRUE;
		$_SESSION['NOME'] = $nome;
		$_SESSION['NIVEL'] = $nivel;
		$_SESSION['MATRICULA'] = $mat;
		$_SESSION['NSENHA'] = $nsenha;
		
		if($nsenha==1){
			header("Location: ../novasenha.php");
			exit;
			
		}else{
			header("Location: ../principal.php");
			exit;
		}
		
	}else{
		$msg = "Dados não conferem";
		header("Location: ../index.php?m=$msg");
		exit;
	}
			
// FECHAR CONEXÃO COM O BD
	mysqli_close($conexao);
?>