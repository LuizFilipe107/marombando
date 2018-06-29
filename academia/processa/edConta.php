<?php
	session_start();
	include_once("../global/banco.php");
	
	$cnMatr = $cnASenha = $cnNSenha = $cnCSenha = null;
	$cnMatr = $_POST['cnMatr'];
	$cnASenha = $_POST['cnASenha'];
	$cnNSenha = $_POST['cnNSenha'];
	$cnCSenha = $_POST['cnCSenha'];

//CASO NÃO HAJA MATRÍCULA
	if($cnMatr == ''){
		$msg = "Ocorreu um erro ao acessar os dados, tente novamente";
		header("Location: ../principal.php?m=$msg");
		mysqli_close($conexao);
		exit;
	}
	
//VERIFICA E ALTERA SENHA
	if(($cnNSenha != '' OR $cnCSenha != '') AND $cnASenha == ''){
		$msg = "Preencha todos os campos de senha";
		header("Location: ../conta.php?m=$msg");
		mysqli_close($conexao);
		exit;
	}

	if($cnASenha != ''){
		$cnASenha = md5($cnASenha);
		
		$bsenha = mysqli_prepare($conexao,"SELECT senha FROM usuario WHERE matricula = ?");
		mysqli_stmt_bind_param($bsenha,'i',$cnMatr);
	
		$rsenha = null;
		mysqli_stmt_execute($bsenha);	
		mysqli_stmt_bind_result($bsenha, $rsenha);
		mysqli_stmt_fetch($bsenha);
		mysqli_stmt_close($bsenha);
		
		if($cnASenha == $rsenha){
			if($cnNSenha == '' OR $cnCSenha == ''){
				$msg = "Digite nova senha e confirmação";
				header("Location: ../conta.php?m=$msg");
				mysqli_close($conexao);
				exit;
			}
			
			if($cnNSenha == $cnCSenha){
				$cnNSenha = md5($cnNSenha);
					$novaS = mysqli_prepare ($conexao,"UPDATE usuario SET senha = ? WHERE matricula = ? ");
					mysqli_stmt_bind_param($novaS,'si', $cnNSenha, $cnMatr);
					mysqli_stmt_execute($novaS);
				if (!(mysqli_stmt_execute($novaS))){
					$msg = "Ocorreu um erro ao alterar a senha";
					header("Location: ../conta.php?m=$msg");
					mysqli_stmt_close($novaS);
					exit;
				}else{
					$novaSOK = 1;
					mysqli_stmt_close($novaS);
				}
			}else{
				$msg = "Senha nova e confirmação não conferem";
				header("Location: ../conta.php?m=$msg");
				mysqli_close($conexao);
				exit;
			}
		}else{
			$msg = "Senha atual não confere";
			header("Location: ../conta.php?m=$msg");
			mysqli_close($conexao);
			exit;
		}
	}

//RECUPERA DADOS		
	$cnMail = $cnTele = $ntel = null;
	
	$cnMail = $_POST['cnMail'];
	$cnTele = $_POST['cnTele'];
//TELEFONE NOVO
	$ntel = $_POST['ntel'];	
		
//VERIFICAR SE OS CAMPOS ESTÃO PREENCHIDOS
	if ($cnMail == ''){
		$msg = "email não pode estar em branco";
		header("Location: ../conta.php?m=$msg");
		mysqli_close($conexao);
		exit;
	}
	
	if ($cnTele == ''){
		$msg = "Telefone não pode estar em branco";
		header("Location: ../conta.php?m=$msg");
		mysqli_close($conexao);
		exit;
	}

//ALTERA DADOS
	$cnAltera = mysqli_prepare ($conexao,"UPDATE usuario SET email = ? WHERE matricula = ? ");
		mysqli_stmt_bind_param($cnAltera,'si', $cnMail, $cnMatr);

	if($ntel == 1){
		$cnTelefone = mysqli_prepare ($conexao,"INSERT INTO telefone VALUES (?,?)");
		mysqli_stmt_bind_param($cnTelefone,'is', $cnMatr, $cnTele);
	}else{
		$cnTelefone = mysqli_prepare ($conexao,"UPDATE telefone SET telefone = ? WHERE mtuser = ? ");
		mysqli_stmt_bind_param($cnTelefone,'si', $cnTele, $cnMatr);
	}	
		
	mysqli_stmt_execute($cnAltera);	
	mysqli_stmt_execute($cnTelefone);
	
//FECHAR CONEXÃO	
	
	if($novaSOK == 1){
		session_destroy();
		$msg = "Alterações Efetuadas";
		header("Location: ../index.php?m=$msg");
			mysqli_stmt_close($cnAltera);
			mysqli_stmt_close($cnTelefone);
			mysqli_close($conexao);
		exit;
	}
	
	if((mysqli_stmt_execute($cnAltera)) AND (mysqli_stmt_execute($cnTelefone))){
		$msg = "Alterações Efetuadas";
		header("Location: ../conta.php?m=$msg");
			mysqli_stmt_close($cnAltera);
			mysqli_stmt_close($cnTelefone);
			mysqli_close($conexao);
		exit;
	}else{
		$msg = "Ocorreu um erro ao alterar os dados";
		header("Location: ../conta.php?m=$msg");
			mysqli_stmt_close($cnAltera);
			mysqli_stmt_close($cnTelefone);
			mysqli_close($conexao);
		exit;
	}
?>


