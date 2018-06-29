<!doctype html>
<html>
	<head>
		<?php include_once("global/head.php");?>
		<title>Autenticação</title>
		<script src="js/jquery.mask.js"></script>
	</head>
	
<script>
    $(document).ready(function () { 
        var $campoMat = $("#login");
        $campoMat.mask('000000', {reverse: true});
    });
</script>

	<body class="bgimg">
		<?php include_once("menub.php");?>
		<div class="container logtable">
			<form action="processa/cLogin.php" method="post">
				<div class="container" style="max-width: 370px;">
					<div class="row">
						<div class="col-md-12">
							<img src="images/Logop.png" class="img-responsive" alt="Marombando"/>
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
							<input class="form-control input-lg" id="login" type="text" name="login" size="35" placeholder="Matrícula">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<input class="form-control input-lg" id="senha" type="password" name="senha" size="30" placeholder="Senha">
						</div>
					</div>
					<div class="row">
						</br>
					</div>
					<div class="row">
					  <div class="col-md-12">
						<div class="btn-group btn-group-justified" role="group" aria-label="group button">
							<div class="btn-group" role="group">
								<button type="submit" id="enviar" class="btn btn-success btn-hover-green" data-action="save" role="button">Enviar</button>
							</div>
							<div class="btn-group" role="group">
								<button type="reset" id="limpar" class="btn btn-info btn-hover-green" role="button">Limpar</button>
							</div>
						</div>
					  </div>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>