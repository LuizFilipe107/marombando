<?php
	//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	include_once("global/auth.php");

	if($_SESSION['NIVEL'] == 9){
		include_once("global/banco.php");
		
		$reccen = null;
		$reccen = mysqli_prepare
			($conexao,"SELECT peso, DATE_FORMAT(data, '%d/%m/%Y') 
						FROM peso WHERE mtuser = ? 
						ORDER BY data DESC LIMIT 1");
				mysqli_stmt_bind_param($reccen,'i',$_SESSION['MATRICULA']);
				mysqli_stmt_execute($reccen);	
				mysqli_stmt_bind_result($reccen, $rcPes, $rcDat);
				mysqli_stmt_fetch($reccen);
				mysqli_stmt_close($reccen);
		
		$reccen = null;	
		$reccen = mysqli_prepare
			($conexao,"SELECT DATE_FORMAT(data, '%d/%m/%Y') 
				FROM avaliacao WHERE mtuser = ? 
				ORDER BY data DESC LIMIT 1");
			
				mysqli_stmt_bind_param($reccen,'i', $_SESSION['MATRICULA']);
				mysqli_stmt_execute($reccen);	
				mysqli_stmt_bind_result($reccen, $rcAva);
				mysqli_stmt_fetch($reccen);
				mysqli_stmt_close($reccen);
	}
	
	
?>

<div class="container">
	<div class="row">
	<div style="max-width: 600px;">
	<div class="modal-content">
		<div class="modal-header-cust">
			<b class="modal-title">
				<?php if($_SESSION['NIVEL'] == 3){ ?>
				<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Novas Mensagens <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
				<?php }else{ ?>
				<span class="glyphicon glyphicon-star" aria-hidden="true"></span> Menu Rápido <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
				<?php }; ?>
			</b>
		</div>
		<div class="modal-body">
			
			<?php if($_SESSION['NIVEL'] == 1){ ?>
				<div class="row">
					<div class="col-md-6">
						<img id="admMenu1" class="img-responsive center-block" src="images/icm_cger.png" alt="Icon" data-toggle="modal" data-target="#cadGerente" role="button">
						<label for="admMenu1">Cadastrar Gerente</label>
					</div>
					<div class="col-md-6">
						<img id="admMenu2" class="img-responsive center-block" src="images/icm_pass.png" alt="Icon" data-toggle="modal" data-target="#modalSenha" role="button">
						<label for="admMenu2">Resetar Senha</label>
					</div>
				</div>
			<?php }; ?>

			<?php if($_SESSION['NIVEL'] == 2){ ?>
				<div class="row">
					<div class="col-md-4">
						<img id="gerMenu1" class="img-responsive center-block" src="images/icm_calun.png" alt="Icon" data-toggle="modal" data-target="#cadAluno" role="button">
						<label for="gerMenu1">Cadastrar Aluno</label>
					</div>
					<div class="col-md-4">
						<img id="gerMenu2" class="img-responsive center-block" src="images/icm_cger.png" alt="Icon" data-toggle="modal" data-target="#cadInstrutor" role="button">
						<label for="gerMenu2">Cadastrar Instrutor</label>
					</div>
					<div class="col-md-4">
						<img id="gerMenu3" class="img-responsive center-block" src="images/icm_pass.png" alt="Icon" data-toggle="modal" data-target="#modalSenha" role="button">
						<label for="gerMenu3">Resetar Senha</label>
					</div>
				</div>
			<?php }; ?>

			<?php if($_SESSION['NIVEL'] == 3){ ?>
			<img src="images/t_inst.png" alt="menu instrutor">
			<?php }; ?>

			<?php if($_SESSION['NIVEL'] == 9){ ?>
				<div class="row">
					<div class="col-md-5">
						<div class="container-fluid">
							<div class="col-md-12" style="text-align:left;">
								<label for="avData">Última Avaliação</label>
								<p id="avData" style="font-size: 200%;"><?php echo $rcAva; if(!$rcAva){echo "-";};?></p>
							</div>
							<div class="col-md-12" style="text-align:left;">
								<label for="avData">Peso em: <?php echo $rcDat; ?></label>
								<p id="avData" style="font-size: 200%;"><?php echo $rcPes; if(!$rcPes){echo "-";}else{echo " Kg";}; ?></p>
							</div>
						</div>
					</div>
					<div class="col-md-3 container-fluid">
						<label for="aluMenu2">Novo Peso</label>
						<img id="aluMenu2" class="img-responsive center-block" src="images/icm_npes.png" alt="Icon" data-toggle="modal" data-target="#modalPeso" role="button">
					
						<!--<img id="aluMenu2" class="img-responsive center-block" src="images/al02.png" alt="Icon" data-toggle="modal" data-target="#modalPeso" role="button">
						-->
					</div>
					<div class="col-md-4">
						<label for="aluMenu3">0 mensagens</label>
						<img id="aluMenu3" class="img-responsive center-block" src="images/icm_mens.png" alt="Icon" data-toggle="modal" data-target="#" role="button">
					
						<!-- <img src="images/al03.png" alt="menu aluno">
						-->
					</div>
				</div>
			<?php }; ?>
			
			<div class="row">
				<div class="col-md-6">
					
				</div>
				<div class="col-md-6">
					
				</div>
			</div>

		</div>
	</div>
	</div>
	</div>
</div>
