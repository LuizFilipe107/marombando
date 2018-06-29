<!doctype html>
<html>
	<head>
		<?php include_once("global/head.php");?>
		<title>Nova Senha</title>
	</head>

	<body class="bgimg">
		<?php include_once("menub.php");?>
		<div class="container logtable">
			<form action="processa/cSenha.php" method="post">
				<div class="container" style="max-width: 370px;">
					<div class="row" style="text-align:center;">
						<div class="col-md-12">
							<h2>Digite uma nova senha</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
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
					<div class="row">
						<div class="col-md-12">
							<input class="form-control" id="nsenha" type="password" name="nsenha" size="30" placeholder="Nova senha">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<input class="form-control" id="ncsenha" type="password" name="ncsenha" size="30" placeholder="Confirme a senha">
						</div>
					</div>
					<div class="row">
						</br>
					</div>
					<div class="row">
					  <div class="col-md-12">
						<div class="btn-group btn-group-justified" role="group" aria-label="group button">
							<div class="btn-group" role="group">
								<button type="submit" id="nenviar" class="btn btn-success btn-hover-green" data-action="save" role="button">Enviar</button>
							</div>
							<div class="btn-group" role="group">
								<button type="reset" id="nlimpar" class="btn btn-info btn-hover-green" role="button">Limpar</button>
							</div>
						</div>
					  </div>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>