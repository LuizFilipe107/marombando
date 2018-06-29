<?php
//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	include_once("global/auth.php");
	
	// RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
	$aCod = $rMat = $rNom = null;
	$aCod = $_GET['c'];
	
	include_once("global/banco.php");

	$gRec = mysqli_prepare ($conexao,
								"SELECT u.matricula, u.nome FROM usuario u WHERE u.matricula = ?");
	mysqli_stmt_bind_param($gRec,'i',$aCod);
	mysqli_stmt_execute($gRec);	
	mysqli_stmt_bind_result($gRec, $rMat, $rNom );
	mysqli_stmt_fetch($gRec);
	mysqli_stmt_close($gRec);

?>

<!doctype html>
<html>
	<head>
		<?php include_once("global/head.php");?>
		<title>Nova Avaliação</title>
		
<script src="js/jquery.mask.js"></script>
<script>
    $(document).ready(function () { 
		var $cavAltu = $("#avAltu");
			$cavAltu.mask('0.00', {reverse: false});
		var $cbicEsq = $("#bicEsq");
			$cbicEsq.mask('000.0', {reverse: true});
		var $cantEsq = $("#antEsq");
			$cantEsq.mask('000.0', {reverse: true});
		var $cbicDir = $("#bicDir");
			$cbicDir.mask('000.0', {reverse: true});
		var $cantDir = $("#antDir");
			$cantDir.mask('000.0', {reverse: true});
		var $ccoxEsq = $("#coxEsq");
			$ccoxEsq.mask('000.0', {reverse: true});
		var $cpanEsq = $("#panEsq");
			$cpanEsq.mask('000.0', {reverse: true});
		var $ccoxDir = $("#coxDir");
			$ccoxDir.mask('000.0', {reverse: true});
		var $cpanDir = $("#panDir");
			$cpanDir.mask('000.0', {reverse: true});
		var $cavOmbr = $("#avOmbr");
			$cavOmbr.mask('000.0', {reverse: true});
		var $cavPeit = $("#avPeit");
			$cavPeit.mask('000.0', {reverse: true});
		var $cavCint = $("#avCint");
			$cavCint.mask('000.0', {reverse: true});
	});
</script>
		
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
		<form action="processa/regavaliacao.php" method="post">
		<!-- LINHA 1 -->
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="avMatr">Matrícula</label>
						<input type="text" class="form-control" id="avMatr" name="avMatr" readonly value="<?php echo $rMat; ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="avNome">Nome</label>
						<input type="text" class="form-control" id="avNome" name="avNome" maxlength="80" readonly value="<?php echo $rNom; ?>">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="avAltu">Altura</label>
						<input type="text" class="form-control" id="avAltu" name="avAltu" maxlength="3" placeholder="0.00 m">
					</div>
				</div>
			</div>
		<!-- LINHA 2 -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="navdata">Data</label>
						<input type="date" class="form-control" id="navdata" name="navdata" placeholder="aaaa/mm/dd">
					</div>
				</div>
			</div>
			<div></br></div>
		<!-- LINHA 3 -->
		<fieldset>
		<legend>Braços</legend>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="bicEsq">Bíceps esquerdo</label>
						<input type="decimal" class="form-control" id="bicEsq" name="bicEsq" maxlength="4" placeholder="00.0 cm">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="antEsq">Antebraço esquerdo</label>
						<input type="decimal" class="form-control" id="antEsq" name="antEsq" maxlength="4" placeholder="00.0 cm">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="bicDir">Bíceps direito</label>
						<input type="decimal" class="form-control" id="bicDir" name="bicDir" maxlength="4" placeholder="00.0 cm">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="antDir">Antebraço direito</label>
						<input type="decimal" class="form-control" id="antDir" name="antDir" maxlength="4" placeholder="00.0 cm">
					</div>
				</div>
			</div>
		</fieldset>
		<div></br></div>
		<!-- LINHA 4 -->
		<fieldset>
		<legend>Pernas</legend>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="coxEsq">Coxa esquerda</label>
						<input type="decimal" class="form-control" id="coxEsq" name="coxEsq" maxlength="4" placeholder="00.0 cm">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="panEsq">Panturrílha esquerda</label>
						<input type="decimal" class="form-control" id="panEsq" name="panEsq" maxlength="4" placeholder="00.0 cm">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="coxDir">Coxa direita</label>
						<input type="decimal" class="form-control" id="coxDir" name="coxDir" maxlength="4" placeholder="00.0 cm">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="panDir">Panturrílha direita</label>
						<input type="decimal" class="form-control" id="panDir" name="panDir" maxlength="4" placeholder="00.0 cm">
					</div>
				</div>
			</div>
		</fieldset>
		<div></br></div>
		<!-- LINHA 5 -->
			<div class="row">
				<div class="col-md-4">
					<fieldset>
					<legend>Ombros</legend>
						<div class="form-group">
							<label for="avOmbr">Ombros</label>
							<input type="decimal" class="form-control" id="avOmbr" name="avOmbr" maxlength="4" placeholder="00.0 cm">
						</div>
					</fieldset>
				</div>
				<div class="col-md-4">
					<fieldset>
					<legend>Peito</legend>
						<div class="form-group">
							<label for="avPeit">Peito</label>
							<input type="decimal" class="form-control" id="avPeit" name="avPeit" maxlength="4" placeholder="00.0 cm">
						</div>
					</fieldset>
				</div>
				<div class="col-md-4">
					<fieldset>
					<legend>Cintura</legend>
						<div class="form-group">
							<label for="avCint">Cintura</label>
							<input type="decimal" class="form-control" id="avCint" name="avCint" maxlength="4" placeholder="00.0 cm">
						</div>
					</fieldset>
				</div>
			</div>
		<div></br></div>
		<!-- LINHA 6 -->
			<small>Preencha todos os campos</small>
		<!-- BOTÕES -->	
			<div class="modal-footer">
				<div class="btn-group btn-group-justified" role="group" aria-label="group button">
					<div class="btn-group" role="group">
						<button type="submit" id="avenviar" class="btn btn-success btn-hover-green" data-action="save" role="button"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registrar</button>
					</div>
					<div class="btn-group" role="group">
						<button type="reset" id="avlimpar" class="btn btn-warning btn-hover-green" role="button"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Limpar</button>
					</div>
					<div class="btn-group" role="group">
						<a href="ialunos.php" class="btn btn-info btn-hover-green" role="button">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Voltar</a>
					</div>
				</div>
			</div>
		</form>
	<!-- FIM AVALIAÇÃO -->
	</div>
	<?php mysqli_close($conexao); ?>
	</body>
</html>