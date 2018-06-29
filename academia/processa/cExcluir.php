<?php
// 1. VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	include_once("../global/auth.php");
		
// 2. RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
	$cCodigo = $_GET['c'];
	
	if ((substr($cCodigo,'0',1)=='2')){
		$tipo = 2;
	}elseif ((substr($cCodigo,'0',1))=='3'){
		$tipo = 3;
	}elseif ((substr($cCodigo,'0',1))=='9'){
		$tipo = 9;
	}else{
		$tipo = null;
	}
	
// 3. VALIDAR OS DADOS ENVIADOS PELO FORMULÁRIO(VALIDAÇÕES)
	// 3.1. VERIFICAR SE OS CAMPOS ESTÃO PREENCIDOS
	if($cCodigo == ""){
		$msg = "Erro ao selecionar usuário";
		header("Location: ../principal.php?m=$msg");
		exit;
	}	

//5. BANCO DE DADOS
	include_once("../global/banco.php");
	
// 6. CRIAR SCRIPT SQL	
	$stmx = mysqli_prepare($conexao,"DELETE FROM usuario WHERE matricula = ?");
			mysqli_stmt_bind_param($stmx,'i',$cCodigo);
// 7. EXECUTAR SCRIPT SQL			
			mysqli_stmt_execute($stmx);

// 9. REALIZAR OS PROCESSAMENTOS NECESSÁRIOS (...)
	if(mysqli_stmt_execute($stmx) == true){
		if($tipo == "2"){
			$msg = "Gerente excluido com sucesso";		
			header("Location: ../gerentes.php?m=$msg");
			exit;}
		if($tipo == "3"){
			$msg = "Instrutor excluido com sucesso";		
			header("Location: ../instrutores.php?m=$msg");
			exit;}
		if($tipo == "9"){
			$msg = "Aluno excluido com sucesso";		
			header("Location: ../alunos.php?m=$msg");
			exit;}
		if($tipo == ""){
			$msg = "Usuário excluido com sucesso";		
			header("Location: ../principal.php?m=$msg");
			exit;}
	}else{
		if($tipo == "2"){
			$msg = "Nao foi possivel excluir o gerente.<br/>";
			$msg .= mysqli_error();//msg de erro do BD		
			header("Location: ../gerentes.php?m=$msg");
			exit;}
		if($tipo == "3"){
			$msg = "Nao foi possivel excluir o instrutor.<br/>";
			$msg .= mysqli_error();//msg de erro do BD		
			header("Location: ../instrutores.php?m=$msg");
			exit;}
		if($tipo == "9"){
			$msg = "Nao foi possivel excluir o aluno.<br/>";
			$msg .= mysqli_error();//msg de erro do BD		
			header("Location: ../alunos.php?m=$msg");
			exit;}
		if($tipo == ""){
			$msg = "Nao foi possivel excluir o usuário.<br/>";
			$msg .= mysqli_error();//msg de erro do BD		
			header("Location: ../principal.php?m=$msg");
			exit;}
	}

// 11. FECHAR CONEXÃO COM O BD
	mysqli_stmt_close($stmx);
	mysqli_close($conexao);
?>