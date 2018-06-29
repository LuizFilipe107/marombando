<?php
//BUSCAR DADOS DO GRÁFICO
	include_once("banco.php");
	
//BUSCA INSTRUTOR
$stmt0 = mysqli_prepare
	($conexao,"SELECT u.instrutor FROM aluno u WHERE u.mtuser = ?");
	mysqli_stmt_bind_param($stmt0,'i',$_SESSION['MATRICULA']);

	mysqli_stmt_execute($stmt0);	
	mysqli_stmt_bind_result($stmt0, $inst);
	mysqli_stmt_fetch($stmt0);

	$_SESSION['INSTRUTOR'] = $inst;

//FECHAR CONEXÃO	
	mysqli_stmt_close($stmt0);	
	
//BUSCA GRAFICO
	$stmt = mysqli_prepare
	($conexao,"SELECT 
					p.peso,
					DATE_FORMAT(p.data, '%d'),
					DATE_FORMAT(p.data, '%m'),
					DATE_FORMAT(p.data, '%Y'),
					DATE_FORMAT(p.data, '%d/%m/%Y')
				FROM
					peso p
				WHERE p.mtuser = ?
				ORDER BY p.data DESC
				LIMIT 5");
			mysqli_stmt_bind_param($stmt,'i',$_SESSION['MATRICULA']);

	mysqli_stmt_execute($stmt);	
	mysqli_stmt_bind_result($stmt, $pes, $datD, $datM, $datA, $datU);
	mysqli_stmt_fetch($stmt);
	
	$_SESSION['ULTDATA'] = $datU;
	
	do{
        $peso[] = $pes;
		$dataD[] = $datD;
		$dataM[] = $datM;
		$dataA[] = $datA;
    }while (mysqli_stmt_fetch($stmt));

	$_SESSION['ULTPESO'] = $peso[0];

//FECHAR CONEXÃO	
	mysqli_stmt_close($stmt);
	
//BUSCA DADOS
	$stmt2 = mysqli_prepare
	($conexao,"SELECT 
					DATE_FORMAT(a.data, '%d/%m/%Y') 
				FROM
					avaliacao a
				WHERE
					a.mtuser = ?
				ORDER BY a.data DESC
				LIMIT 1");
			mysqli_stmt_bind_param($stmt2,'i', $_SESSION['MATRICULA']);

	mysqli_stmt_execute($stmt2);	
	mysqli_stmt_bind_result($stmt2, $datV);
	mysqli_stmt_fetch($stmt2);
	
	$dataAV = $datV;
	
//FECHAR CONEXÃO	
	mysqli_stmt_close($stmt2);
	
//BUSCA INSTRUTOR
	$stmt3 = mysqli_prepare
	($conexao,"SELECT 
					s.nome
				FROM
					usuario s 
				WHERE
					s.matricula = ?");
			mysqli_stmt_bind_param($stmt3,'i', $_SESSION['INSTRUTOR']);

	mysqli_stmt_execute($stmt3);	
	mysqli_stmt_bind_result($stmt3, $nomI);
	mysqli_stmt_fetch($stmt3);
	
	$nomeINS = $nomI;
	
//FECHAR CONEXÃO	
	mysqli_stmt_close($stmt3);
?>