<?php
	session_start();
	
	$avMatr = $avAltu = $navdata = $bicEsq = $antEsq = $bicDir = $antDir = $coxEsq = $panEsq = $coxDir = $panDir = $avOmbr = $avPeit = $avCint = null;

	$avMatr = $_POST['avMatr'];
	$avAltu = $_POST['avAltu'];
	$navdata = $_POST['navdata'];

	$bicEsq = $_POST['bicEsq'];
	$antEsq = $_POST['antEsq'];

	$bicDir = $_POST['bicDir'];
	$antDir = $_POST['antDir'];

	$coxEsq = $_POST['coxEsq'];
	$panEsq = $_POST['panEsq'];

	$coxDir = $_POST['coxDir'];
	$panDir = $_POST['panDir'];

	$avOmbr = $_POST['avOmbr'];
	$avPeit = $_POST['avPeit'];
	$avCint = $_POST['avCint'];
	
	if($avMatr == ""){
			$msg = "Erro ao selecionar aluno";
			header("Location: ../ialunos.php?m=$msg");
			exit;
		}
		
	if($avAltu == '' OR $navdata == '' OR $bicEsq == '' OR $antEsq == '' OR $bicDir == '' OR $antDir == '' OR $coxEsq == '' OR $panEsq == '' OR $coxDir == '' OR $panDir == '' OR $avOmbr == '' OR $avPeit == '' OR $avCint == ''){
			$msg = "Preencha todos os campos";
			header("Location: ../ialunos.php?m=$msg");
			exit;
		}
	
//REGISTRAR AVALIAÇÃO
	include_once("../global/banco.php");
	
	$regav = mysqli_prepare ($conexao,"INSERT INTO avaliacao VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			mysqli_stmt_bind_param($regav,'isdddddddddddd', $avMatr, $navdata, $avAltu, $avOmbr, $avPeit, $avCint, $bicDir, $bicEsq, $antDir, $antEsq, $coxDir, $coxEsq, $panDir, $panEsq);

	mysqli_stmt_execute($regav);	
	
	//FECHAR CONEXÃO	

	if(mysqli_stmt_execute($regav)){
		$msg = "Avaliação registrada";
		header("Location: ../ialunos.php?m=$msg");
		mysqli_stmt_close($regav);
		mysqli_close($conexao);
		exit;
	}

	if (!(mysqli_stmt_execute($regav))) {
		$msg = "Erro de acesso ao banco de dados";
		header("Location: ../ialunos.php?m=$msg");
		mysqli_stmt_close($regav);
		mysqli_close($conexao);
		exit;
	}
?>