<?php
//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	include_once("global/auth.php");
	
	// RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
	$aCod = $iRec = $rMat = $rNom = $rMai = $rAti = $rObs = null;
	$aCod = $_GET['c'];
	
	include_once("global/banco.php");

	$iRec = mysqli_prepare ($conexao,
								"SELECT 
								u.matricula, u.nome, u.email, u.ativo, u.obs 
								FROM
								usuario u
							WHERE
								u.matricula = ?");
	mysqli_stmt_bind_param($iRec,'i',$aCod);
	mysqli_stmt_execute($iRec);	
	mysqli_stmt_bind_result($iRec, $rMat, $rNom, $rMai, $rAti, $rObs );
	mysqli_stmt_fetch($iRec);
	mysqli_stmt_close($iRec);

/*	$tRec = null;
	$tRec = mysqli_prepare ($conexao, "SELECT telefone FROM telefone WHERE mtuser = ?");
	mysqli_stmt_bind_param($tRec,'i',$aCod);
	mysqli_stmt_execute($tRec);
	mysqli_stmt_bind_result($tRec, $gTel);
	mysqli_stmt_fetch($tRec);

	do{
		$rTel[] = $gTel;
	}while(mysqli_stmt_fetch($tRec));

	mysqli_stmt_close($tRec);
*/
?>

<!doctype html>
<html>
	<head>
		<?php include_once("global/head.php");?>
		<title>Detalhes</title>
	</head>
	
	<body class="bgimg">
	<?php include_once("menu.php");?>
	<div class="container">
	
	<div class="container-fluid">
	<div class="row" style="text-align:center">
		<div class="col-md-12">
			<h1>Detalhes</h1>
		</div>
	</div>
	</br>
		<form action="processa/edInstrutor.php" method="post">
		<!-- LINHA 1 -->
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="inMatr">Matrícula</label>
						<input type="text" class="form-control" id="inMatr" name="inMatr" readonly value="<?php echo $rMat; ?>">
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<label for="inNome">Nome*</label>
						<input type="text" class="form-control" id="inNome" name="inNome" maxlength="80" value="<?php echo $rNom; ?>">
					</div>
				</div>
			</div>
		<!-- LINHA 2 -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="inMail">e-Mail</label>
						<input type="text" class="form-control" id="inMail" name="inMail" maxlength="40" value="<?php echo $rMai; ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="inTele">Telefone</label>
						<input type="text" class="form-control" id="inTele" placeholder="(00) 99000-0000" name="inTele" maxlength="12">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="inAti">Ativo</label>
						<select class="form-control" id="inAti" name="inAti">
							<option value="1" <?php if($rAti == 1){echo("selected");}?>>Sim</option>
							<option value="0" <?php if($rAti == 0){echo("selected");}?>>Não</option>
						</select>
					</div>
				</div>
			</div>
		<!-- LINHA 3 -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="inObs">Observações</label>
						<textarea class="form-control" id="inObs" name="inObs" style="resize: none"  maxlength="100"><?php echo $rObs; ?></textarea>
					</div>
				</div>
			</div>
			<span>(*) Preenchimento Obrigatório</span>
		<!-- BOTÕES -->
			<div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                    <button type="submit" id="alenviar" class="btn btn-success btn-hover-green" data-action="save" role="button"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Alterar</button>
                </div>
				<div class="btn-group" role="group">
					<a href="instrutores.php" class="btn btn-danger" role="button">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Voltar</a>
				</div>
            </div>
			</div>
		</form>
	</div>
	<!-- FIM EDITA INSTRUTOR -->
	</div>
	<?php mysqli_close($conexao); ?>
	</body>
</html>