<?php
	//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	include_once("global/auth.php");
?>
<div class="container-fullwidth">
	<nav class="navbar navbar-inverse navbar-static-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="principal.php" class="navbar-brand">Marombando</a>
			</div>
			
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<?php if($_SESSION['NIVEL'] == 1){ ?>
						<li><a href="gerentes.php">Gerentes</a></li>
					<?php }; ?>
					<?php if($_SESSION['NIVEL'] == 1 or $_SESSION['NIVEL'] == 2){ ?>
						<li><a href="alunos.php">Alunos</a></li>
						<li><a href="instrutores.php">Instrutores</a></li>
					<?php }; ?>
					<?php if($_SESSION['NIVEL'] == 9){ ?>
						<li><a href="aresumo.php">Resumo</a></li>
					<?php }; ?>
					<?php if($_SESSION['NIVEL'] == 3){ ?>
						<li><a href="ialunos.php">Alunos</a></li>
					<?php }; ?>
					<?php if($_SESSION['NIVEL'] == 9 or $_SESSION['NIVEL'] == 3){ ?>
						<li><a href="#">Mensagens</a></li>
					<?php }; ?>
					<li><a href="conta.php">Conta</a></li>
					<li><a data-toggle="modal" href="#sobreM">Sobre</a></li>
					<li><a href="global/logout.php">Sair</a></li>
				</ul>
			</div>
		</div>
	</nav>
</div>

<div class="container-fluid">
  <div class="modal fade" id="sobreM" role="dialog">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Marombando</h4>
		</div>
		<div style="text-align:center" class="modal-body">
		  <p>Marombando - Versão 1.0.5</p>
		  <p>Contato: suporte@marombando.rf.gd</p>
		  <p>Copyright 2017 - Marombando Inc</p>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		</div>
	  </div>
	</div>
  </div>
</div>

