<?php
//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	include_once("global/auth.php");
	
	// RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
	$aCod = null;
	$aCod = $_GET['c'];
	
	include_once("global/banco.php");

	$aRec = mysqli_prepare ($conexao,
								"SELECT 
								u.matricula, u.nome, u.email, u.ativo, u.obs,
								a.cpf, a.sexo, a.instrutor,
								e.endereco, e.numero, e.complemento, e.cidade, e.cep, e.estado
							FROM
								usuario u,
								aluno a,
								endereco e
							WHERE
								a.mtuser = u.matricula
									AND e.mtuser = u.matricula
									AND u.matricula = ?");
	mysqli_stmt_bind_param($aRec,'i',$aCod);
	mysqli_stmt_execute($aRec);	
	mysqli_stmt_bind_result($aRec, 
					$ruMat, $ruNom, $ruMai, $ruAti, $ruObs, 
					$raCpf, $raSex, $raIns, 
					$reEnd, $reNum, $reCom, $reCid, $reCep, $reEst );
	mysqli_stmt_fetch($aRec);
	mysqli_stmt_close($aRec);
					
	$tRec = mysqli_prepare ($conexao, "SELECT telefone FROM telefone WHERE mtuser = ?");
	mysqli_stmt_bind_param($tRec,'i',$aCod);
	mysqli_stmt_execute($tRec);
	mysqli_stmt_bind_result($tRec, $aTel);
	mysqli_stmt_fetch($tRec);

	do{
		$rTel[] = $aTel;
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
			<a <?php if($_SESSION['NIVEL'] == 3){echo "href='ialunos.php'";}else{echo "href='alunos.php'";};?> class="btn btn-lg btn-warning" role="button">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Voltar</a>
		</div>
	</div>
	</br>
		<form>
		<!-- LINHA 1 -->
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="alMatr">Matrícula</label>
						<input type="text" class="form-control" id="alMatr" name="alMatr" readonly value="<?php echo $ruMat; ?>">
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<label for="alCpf">CPF</label>
						<input type="text" class="form-control" id="alCpf" name="alCpf" maxlength="11" readonly value="<?php echo $raCpf; ?>">
					</div>
				</div>
			</div>
		<!-- LINHA 2 -->
			<div class="row">
				<div class="col-md-10">
					<div class="form-group">
						<label for="alNome">Nome</label>
						<input type="text" class="form-control" id="alNome" name="alNome" maxlength="80" readonly value="<?php echo $ruNom; ?>">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="alSexo">Sexo</label>
						<input type="text" class="form-control" id="alSexo" name="alSexo" readonly 
							value="<?php if($raSex == 'M'){echo("Masculino");}else{echo("Feminino");};?>">
					</div>
				</div>
			</div>
		<!-- LINHA 3 -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="alMail">e-Mail</label>
						<input type="text" class="form-control" id="alMail" name="alMail" maxlength="40" readonly value="<?php echo $ruMai; ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="alTele">Telefone</label>
						<select class="form-control" id="alTele" name="alTele" readonly>
							<?php foreach($rTel as $option){?>
							<option><?php echo $option; ?></option>
							<?php };?>
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="alAti">Ativo</label>
						<input type="text" class="form-control" id="alAti" name="alAti" maxlength="40" readonly value="<?php 
						if($ruAti==1){
							echo "Sim";
						}else{echo "Não";
						}?>">
					</div>
				</div>
			</div>
		<!-- LINHA 4 -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="alInst">Instrutor</label>
						<input type="text" class="form-control" id="alInst" name="alInst" readonly value="<?php echo $raIns; ?>">
					</div>
				</div>
			</div>
		<!-- LINHA 5 -->
			<div class="row">
				<div class="col-md-10">
					<div class="form-group">
						<label for="alEnde">Endereço</label>
						<input type="text" class="form-control" id="alEnde" name="alEnde" maxlength="100" readonly value="<?php echo $reEnd; ?>">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="alNume">Número</label>
						<input type="text" class="form-control" id="alNume" name="alNume" maxlength="7" readonly value="<?php echo $reNum; ?>">
					</div>
				</div>
			</div>
		<!-- LINHA 6 -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="alComp">Complemento</label>
						<input type="text" class="form-control" id="alComp" name="alComp" maxlength="80" readonly value="<?php echo $reCom; ?>">
					</div>
				</div>
			</div>
		<!-- LINHA 7 -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="alCida">Cidade</label>
						<input type="text" class="form-control" id="alCida" name="alCida" maxlength="60" readonly value="<?php echo $reCid; ?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="alCep">CEP</label>
						<input type="text" class="form-control" id="alCep" name="alCep" maxlength="8" readonly value="<?php echo $reCep; ?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="alEsta">Estado</label>
						<input type="text" class="form-control" id="alEsta" name="alEsta" readonly 
						value="<?php
							if($reEst == 'AC'){echo "Acre";};
							if($reEst == 'AL'){echo "Alagoas";};
							if($reEst == 'AP'){echo "Amapá";};
							if($reEst == 'AM'){echo "Amazonas";};
							if($reEst == 'BA'){echo "Bahia";};
							if($reEst == 'CE'){echo "Ceará";};
							if($reEst == 'DF'){echo "Distrito Federal";};
							if($reEst == 'ES'){echo "Espírito Santo";};
							if($reEst == 'GO'){echo "Goiás";};
							if($reEst == 'MA'){echo "Maranhão";};
							if($reEst == 'MT'){echo "Mato Grosso";};
							if($reEst == 'MS'){echo "Mato Grosso do Sul";};
							if($reEst == 'MG'){echo "Minas Gerais";};
							if($reEst == 'PA'){echo "Pará";};
							if($reEst == 'PB'){echo "Paraíba";};
							if($reEst == 'PR'){echo "Paraná";};
							if($reEst == 'PE'){echo "Pernambuco";};
							if($reEst == 'PI'){echo "Piauí";};
							if($reEst == 'RJ'){echo "Rio de Janeiro";};
							if($reEst == 'RN'){echo "Rio Grande do Norte";};
							if($reEst == 'RS'){echo "Rio Grande do Sul";};
							if($reEst == 'RO'){echo "Rondônia";};
							if($reEst == 'RR'){echo "Roraima";};
							if($reEst == 'SC'){echo "Santa Catarina";};
							if($reEst == 'SP'){echo "São Paulo";};
							if($reEst == 'SE'){echo "Sergipe";};
							if($reEst == 'TO'){echo "Tocantins";};?>">
					</div>
				</div>
			</div>
		<!-- LINHA 8 -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="alObs">Observações</label>
						<textarea class="form-control" id="alObs" name="alObs" style="resize: none"  maxlength="100" readonly><?php echo $ruObs; ?></textarea>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-- FIM CADASTRAR ALUNO -->
	</div>
	</body>
</html>