<?php
//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	include_once("global/auth.php");
	
	// RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
	$aCod = $gRec = $rMat = $rNom = $rMai = null;
	$aCod = $_SESSION['MATRICULA'];
	
	include_once("global/banco.php");

	$gRec = mysqli_prepare ($conexao, 
							"SELECT u.matricula, u.nome, u.email FROM usuario u WHERE u.matricula = ? ");
	mysqli_stmt_bind_param($gRec,'i',$aCod);
	mysqli_stmt_execute($gRec);	
	mysqli_stmt_bind_result($gRec, $rMat, $rNom, $rMai );
	mysqli_stmt_fetch($gRec);
	mysqli_stmt_close($gRec);

	$tRec = $ntel = null;
	$tRec = mysqli_prepare ($conexao, "SELECT telefone FROM telefone WHERE mtuser = ? LIMIT 1");
	mysqli_stmt_bind_param($tRec,'i',$aCod);
	mysqli_stmt_execute($tRec);
	mysqli_stmt_bind_result($tRec, $rTel);
	mysqli_stmt_fetch($tRec);

	mysqli_stmt_close($tRec);
	
	if($rTel == null){
		$ntel = 1;
	}
?>

<!doctype html>
<html>
	<head>
		<?php include_once("global/head.php");?>
		<title>Conta</title>
	</head>
	
	<body class="bgimg">
	<?php include_once("menu.php");?>
	<div class="container">
	
	<div class="container-fluid">
	<div class="row" style="text-align:center">
		<div class="col-md-12">
			<h1>Conta</h1>
			<div class="erromsg">
			<?php
				if (isset($_GET['m']))
				{
					echo $_GET['m'];
					$_GET['m'] = '';
				}
				?>
			</div>
		</div>
	</div>
	</br>
		<form action="processa/edConta.php" method="post">
		<!-- LINHA 1 -->
		<fieldset>
		<legend>Dados</legend>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="cnMatr">Matrícula</label>
						<input type="text" class="form-control" id="cnMatr" name="cnMatr" readonly value="<?php echo $rMat; ?>">
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<label for="cnNome">Nome</label>
						<input type="text" class="form-control" id="cnNome" name="cnNome" maxlength="80" readonly value="<?php echo $rNom; ?>">
					</div>
				</div>
			</div>
		<!-- LINHA 2 -->
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label for="cnMail">e-Mail</label>
						<input type="text" class="form-control" id="cnMail" name="cnMail" maxlength="40" value="<?php echo $rMai; ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="cnTele">Telefone</label>
						<input type="text" class="form-control" id="cnTele" placeholder="(00) 99000-0000" name="cnTele" maxlength="12" value="<?php echo $rTel; ?>">
		<!-- SE EXISTE TELEFONE -->
						<input type="hidden" name="ntel" value="<?php echo $ntel; ?>">
					</div>
				</div>
			</div>
			<div>
				</br>
			</div>
		</fieldset>
		<!-- LINHA 3 -->
		<fieldset>
		<legend>Alterar Senha</legend>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="cnASenha">Senha atual</label>
						<input type="password" class="form-control" id="cnASenha" name="cnASenha" maxlength="30" placeholder="Senha atual">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="cnNSenha">Nova senha</label>
						<input type="password" class="form-control" id="cnNSenha" name="cnNSenha" maxlength="30" placeholder="Nova senha">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="cnCSenha">Confirme a nova senha</label>
						<input type="password" class="form-control" id="cnCSenha" name="cnCSenha" maxlength="30" placeholder="Confirme a senha">
					</div>
				</div>
			</div>
			<small id="tipsenha" class="form-text text-muted">Preencha os três campos caso queira alterar a senha</small>
		</fieldset>
		<!-- BOTÕES -->
			<div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                    <button type="submit" id="alenviar" class="btn btn-success btn-hover-green" data-action="save" role="button"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Alterar</button>
                </div>
				<div class="btn-group" role="group">
					<a href="principal.php" class="btn btn-danger" role="button">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Cancelar</a>
				</div>
            </div>
			</div>
		</form>
	</div>
	<!-- FIM EDITA ALUNO -->
	</div>
	<?php mysqli_close($conexao); ?>
	</body>
</html>