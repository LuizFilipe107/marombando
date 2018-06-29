<?php
//BUSCAR DADOS DO GRÁFICO
	include_once("banco.php");
	
// RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
	$aCod = null;
	$aCod = $_GET['c'];
		
//BUSCA GRAFICO
	$stmt = $pes = $datD = $datM = $datA = $datU = null;
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
	
	mysqli_stmt_bind_param($stmt,'i',$aCod);

	mysqli_stmt_execute($stmt);	
	mysqli_stmt_bind_result($stmt, $pes, $datD, $datM, $datA, $datU);
	mysqli_stmt_fetch($stmt);
	
	do{
        $peso[] = $pes;
		$dataD[] = $datD;
		$dataM[] = $datM;
		$dataA[] = $datA;
    }while (mysqli_stmt_fetch($stmt));
	
	$aUltp = $peso[0];

//FECHAR CONEXÃO	
	mysqli_stmt_close($stmt);
	
//BUSCA DADOS
	$dataAV = null;
	$stmt2 = mysqli_prepare
	($conexao,"SELECT 
					DATE_FORMAT(a.data, '%d/%m/%Y') 
				FROM
					avaliacao a
				WHERE
					a.mtuser = ?
				ORDER BY a.data DESC
				LIMIT 1");
	
	mysqli_stmt_bind_param($stmt2,'i', $aCod);

	mysqli_stmt_execute($stmt2);	
	mysqli_stmt_bind_result($stmt2, $datV);
	mysqli_stmt_fetch($stmt2);
	
	$dataAV = $datV;
	
//FECHAR CONEXÃO	
	mysqli_stmt_close($stmt2);
	
//BUSCA INSTRUTOR
	$stmt3 = $nomA = null;
	$stmt3 = mysqli_prepare
	($conexao,"SELECT nome FROM usuario WHERE matricula = ?");
	
	mysqli_stmt_bind_param($stmt3,'i', $aCod);

	mysqli_stmt_execute($stmt3);	
	mysqli_stmt_bind_result($stmt3, $nomA);
	mysqli_stmt_fetch($stmt3);
	
//FECHAR CONEXÃO	
	mysqli_stmt_close($stmt3);
?>