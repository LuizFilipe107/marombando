<?php
//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	include_once("global/auth.php");
	
	// RECUPERAR OS DADOS DO FORMULÁRIO(HTML)
	$aCod = $aRec = $ruMat = $ruNom = $ruMai = $ruAti = $ruObs = $raCpf = $raSex = 
	$raIns = $reEnd = $reNum = $reCom = $reCid = $reCep = $reEst = $aRec = null;
	
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

/*	$tRec = mysqli_prepare ($conexao, "SELECT telefone FROM telefone WHERE mtuser = ?");
	mysqli_stmt_bind_param($tRec,'i',$aCod);
	mysqli_stmt_execute($tRec);
	mysqli_stmt_bind_result($tRec, $aTel);
	mysqli_stmt_fetch($tRec);

	do{
		$rTel[] = $aTel;
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
		<form action="processa/edAluno.php" method="post">
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
						<label for="alCpf">CPF*</label>
						<input type="text" class="form-control" id="alCpf" name="alCpf" maxlength="11" readonly value="<?php echo $raCpf; ?>">
					</div>
				</div>
			</div>
		<!-- LINHA 2 -->
			<div class="row">
				<div class="col-md-10">
					<div class="form-group">
						<label for="alNome">Nome*</label>
						<input type="text" class="form-control" id="alNome" name="alNome" maxlength="80" value="<?php echo $ruNom; ?>">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="alSexo">Sexo*</label>
						<select class="form-control" id="alSexo" name="alSexo">
							<option value="M" <?php if($raSex == 'M'){echo("selected");}?>>M</option>
							<option value="F" <?php if($raSex == 'F'){echo("selected");}?>>F</option>
						</select>
					</div>
				</div>
			</div>
		<!-- LINHA 3 -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="alMail">e-Mail</label>
						<input type="text" class="form-control" id="alMail" name="alMail" maxlength="40" value="<?php echo $ruMai; ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="alTele">Telefone*</label>
						<input type="text" class="form-control" id="alTele" placeholder="(00) 99000-0000" name="alTele" maxlength="12">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="alAti">Ativo*</label>
						<select class="form-control" id="alAti" name="alAti">
							<option value="1" <?php if($ruAti == 1){echo("selected");}?>>Sim</option>
							<option value="0" <?php if($ruAti == 0){echo("selected");}?>>Não</option>
						</select>
					</div>
				</div>
			</div>
		<!-- LINHA 4 -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="alInst">Instrutor*</label>
						<input type="text" class="form-control" id="alInst" name="alInst" value="<?php echo $raIns; ?>">
					</div>
				</div>
			</div>
		<!-- LINHA 5 -->
			<div class="row">
				<div class="col-md-10">
					<div class="form-group">
						<label for="alEnde">Endereço*</label>
						<input type="text" class="form-control" id="alEnde" name="alEnde" maxlength="100" value="<?php echo $reEnd; ?>">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="alNume">Número*</label>
						<input type="text" class="form-control" id="alNume" name="alNume" maxlength="7" value="<?php echo $reNum; ?>">
					</div>
				</div>
			</div>
		<!-- LINHA 6 -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="alComp">Complemento</label>
						<input type="text" class="form-control" id="alComp" name="alComp" maxlength="80" value="<?php echo $reCom; ?>">
					</div>
				</div>
			</div>
		<!-- LINHA 7 -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="alCida">Cidade*</label>
						<input type="text" class="form-control" id="alCida" name="alCida" maxlength="60" value="<?php echo $reCid; ?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="alCep">CEP</label>
						<input type="text" class="form-control" id="alCep" name="alCep" maxlength="8" value="<?php echo $reCep; ?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="alEsta">Estado*</label>
						<select id="alEsta" name="alEsta" class="form-control">
							<option value="AC" <?php if($reEst == 'AC'){echo("selected");}?>>Acre</option>
							<option value="AL" <?php if($reEst == 'AL'){echo("selected");}?>>Alagoas</option>
							<option value="AP" <?php if($reEst == 'AP'){echo("selected");}?>>Amapá</option>
							<option value="AM" <?php if($reEst == 'AM'){echo("selected");}?>>Amazonas</option>
							<option value="BA" <?php if($reEst == 'BA'){echo("selected");}?>>Bahia</option>
							<option value="CE" <?php if($reEst == 'CE'){echo("selected");}?>>Ceará</option>
							<option value="DF" <?php if($reEst == 'DF'){echo("selected");}?>>Distrito Federal</option>
							<option value="ES" <?php if($reEst == 'ES'){echo("selected");}?>>Espírito Santo</option>
							<option value="GO" <?php if($reEst == 'GO'){echo("selected");}?>>Goiás</option>
							<option value="MA" <?php if($reEst == 'MA'){echo("selected");}?>>Maranhão</option>
							<option value="MT" <?php if($reEst == 'MT'){echo("selected");}?>>Mato Grosso</option>
							<option value="MS" <?php if($reEst == 'MS'){echo("selected");}?>>Mato Grosso do Sul</option>
							<option value="MG" <?php if($reEst == 'MG'){echo("selected");}?>>Minas Gerais</option>
							<option value="PA" <?php if($reEst == 'PA'){echo("selected");}?>>Pará</option>
							<option value="PB" <?php if($reEst == 'PB'){echo("selected");}?>>Paraíba</option>
							<option value="PR" <?php if($reEst == 'PR'){echo("selected");}?>>Paraná</option>
							<option value="PE" <?php if($reEst == 'PE'){echo("selected");}?>>Pernambuco</option>
							<option value="PI" <?php if($reEst == 'PI'){echo("selected");}?>>Piauí</option>
							<option value="RJ" <?php if($reEst == 'RJ'){echo("selected");}?>>Rio de Janeiro</option>
							<option value="RN" <?php if($reEst == 'RN'){echo("selected");}?>>Rio Grande do Norte</option>
							<option value="RS" <?php if($reEst == 'RS'){echo("selected");}?>>Rio Grande do Sul</option>
							<option value="RO" <?php if($reEst == 'RO'){echo("selected");}?>>Rondônia</option>
							<option value="RR" <?php if($reEst == 'RR'){echo("selected");}?>>Roraima</option>
							<option value="SC" <?php if($reEst == 'SC'){echo("selected");}?>>Santa Catarina</option>
							<option value="SP" <?php if($reEst == 'SP'){echo("selected");}?>>São Paulo</option>
							<option value="SE" <?php if($reEst == 'SE'){echo("selected");}?>>Sergipe</option>
							<option value="TO" <?php if($reEst == 'TO'){echo("selected");}?>>Tocantins</option>
						</select>
					</div>
				</div>
			</div>
		<!-- LINHA 8 -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="alObs">Observações</label>
						<textarea class="form-control" id="alObs" name="alObs" style="resize: none"  maxlength="100" ><?php echo $ruObs; ?></textarea>
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
					<a href="alunos.php" class="btn btn-danger" role="button">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Voltar</a>
				</div>
            </div>
        </div>
		</form>
	</div>
	<!-- FIM CADASTRAR ALUNO -->
	</div>
	<?php mysqli_close($conexao); ?>
	</body>
</html>