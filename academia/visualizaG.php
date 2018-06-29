<?php
//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	include_once("global/auth.php");
	
	// RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
	$aCod = null;
	$aCod = $_GET['c'];
	
	include_once("global/banco.php");

	$gRec = mysqli_prepare ($conexao,
								"SELECT 
								u.matricula, u.nome, u.email, u.ativo, u.obs 
								FROM
								usuario u
							WHERE
								u.matricula = ?");
	mysqli_stmt_bind_param($gRec,'i',$aCod);
	mysqli_stmt_execute($gRec);	
	mysqli_stmt_bind_result($gRec, $rMat, $rNom, $rMai, $rAti, $rObs );
	mysqli_stmt_fetch($gRec);
	mysqli_stmt_close($gRec);

	$tRec = null;
	$tRec = mysqli_prepare ($conexao, "SELECT telefone FROM telefone WHERE mtuser = ?");
	mysqli_stmt_bind_param($tRec,'i',$aCod);
	mysqli_stmt_execute($tRec);
	mysqli_stmt_bind_result($tRec, $gTel);
	mysqli_stmt_fetch($tRec);

	do{
		$rTel[] = $gTel;
	}while(mysqli_stmt_fetch($tRec));

	mysqli_stmt_close($tRec);
	mysqli_close($conexao);
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
		<div class="btn-group btn-group-justified" role="group" aria-label="group button">
			<a href="gerentes.php" class="btn btn-lg btn-warning" role="button">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Voltar</a>
		</div>
	</div>
	</br>
		<form>
			<!-- LINHA 1 -->
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="geMatr">Matrícula</label>
						<input type="text" class="form-control" id="geMatr" name="geMatr" readonly value="<?php echo $rMat; ?>">
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<label for="geNome">Nome</label>
						<input type="text" class="form-control" id="geNome" name="geNome" maxlength="80" readonly value="<?php echo $rNom; ?>">
					</div>
				</div>
			</div>
		<!-- LINHA 2 -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="geMail">e-Mail</label>
						<input type="text" class="form-control" id="geMail" name="geMail" maxlength="40" readonly value="<?php echo $rMai; ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="geTele">Telefone</label>
						<select class="form-control" id="geTele" name="geTele" readonly>
							<?php foreach($rTel as $option){?>
							<option><?php echo $option; ?></option>
							<?php };?>
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="geMail">Ativo</label>
						<input type="text" class="form-control" id="geMail" name="geMail" maxlength="40" readonly value="<?php 
						if($rAti==1){
							echo "Sim";
						}else{echo "Não";
						}?>">
					</div>
				</div>
			</div>
		<!-- LINHA 3 -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="geObs">Observações</label>
						<textarea class="form-control" id="geObs" name="geObs" style="resize: none"  maxlength="100" readonly><?php echo $rObs; ?></textarea>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-- FIM CADASTRAR ALUNO -->
	</div>
	</body>
</html>