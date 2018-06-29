<?php
	session_start();
	include_once("../global/banco.php");
	
	$rcod = $_POST['rcod'];

	if($rcod == ""){
			$msg = "Especifique um usuário";
			header("Location: ../principal.php?m=$msg");
			exit;
	}
		
	if (!(substr($rcod,'0',1)=='1' or substr($rcod,'0',1)=='2' or substr($rcod,'0',1)=='3' or substr($rcod,'0',1)=='9')){
		$msg = "Matrícula Inválida";
		header("Location: ../principal.php?m=$msg");
		exit;
	}	
	
	if($_SESSION['NIVEL'] == 1){
		$altSenha = null;
		$altSenha = mysqli_prepare ($conexao,"UPDATE usuario SET senha = 'ef28af523accaf45868d3db38d421c41', novasenha = 1 WHERE matricula = ?");
		mysqli_stmt_bind_param($altSenha,'i', $rcod);
		mysqli_stmt_execute($altSenha);
		mysqli_stmt_close($altSenha);
		
		if($altSenha){
			$msg = "Senha Redefinida";
			header("Location: ../principal.php?m=$msg");
			exit;
			}
			
			if (!mysqli_query($conexao, $altSenha)) {
			printf("Errormessage: %s\n", mysqli_error($link));
			exit;
			}
	}
	
	if($_SESSION['NIVEL'] == 2){
		if ((substr($rcod,'0',1)=='1' or substr($rcod,'0',1)=='2')){
			$msg = "Você não tem permissão para redefinir a senha deste usuário";
			header("Location: ../principal.php?m=$msg");
			exit;
		}
		if ((substr($rcod,'0',1)=='3' or substr($rcod,'0',1)=='9')){
			$consMat = null;
			$consMat = mysqli_prepare ($conexao,"SELECT matricula FROM usuario WHERE matricula = ?");
				mysqli_stmt_bind_param($consMat,'i', $rcod);
				mysqli_stmt_execute($consMat);
				mysqli_stmt_bind_result($consMat, $cMat);
				mysqli_stmt_fetch($consMat);
				mysqli_stmt_close($consMat);

			if ($cMat == null){
				$msg = "Usuário não existente";
				header("Location: ../principal.php?m=$msg");
				exit;
			}else{
				$altSenha = null;
				$altSenha = mysqli_prepare ($conexao,"UPDATE usuario SET senha = 'ef28af523accaf45868d3db38d421c41' WHERE matricula = ?");
				mysqli_stmt_bind_param($altSenha,'i', $rcod);
				mysqli_stmt_execute($altSenha);
				mysqli_stmt_close($altSenha);
				
				if($altSenha){
					$msg = "Senha Redefinida";
					header("Location: ../principal.php?m=$msg");
					exit;
					}
					
					if (!mysqli_query($conexao, $altSenha)) {
						printf("Errormessage: %s\n", mysqli_error($link));
						exit;
					}
			}
		}
	}
?>