<?php
	session_start();
	
	$regdata = $_POST['rdata'];
	$regpeso = $_POST['rpeso'];

	if($regdata == "" AND $regpeso == ""){
			$msg = "Preencha todos os campos";
			header("Location: ../aresumo.php?m=$msg");
			exit;
		}
	
	if($regdata == ""){
			$msg = "Insira uma data válida";
			header("Location: ../aresumo.php?m=$msg");
			exit;
		}
		
	if($regpeso == ""){
			$msg = "Insira um peso válido";
			header("Location: ../aresumo.php?m=$msg");
			exit;
		}
	
//BUSCAR DADOS DO GRÁFICO
	include_once("../global/banco.php");
	
	$stmt3 = mysqli_prepare
	($conexao,"INSERT INTO peso VALUES (?,?,?)");
			mysqli_stmt_bind_param($stmt3,'isd', $_SESSION['MATRICULA'], $regdata, $regpeso);

	mysqli_stmt_execute($stmt3);	
	
	//FECHAR CONEXÃO	
	mysqli_stmt_close($stmt3);
	mysqli_close($conexao);
	
	if($stmt3){
	$msg = "Registro Efetuado ";
	header("Location: ../aresumo.php");
		exit;
	}
	
	if (!mysqli_query($conexao, $stmt3)) {
    printf("Errormessage: %s\n", mysqli_error($link));
	exit;
}
	
?>