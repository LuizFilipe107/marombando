<?php
include_once("global/banco.php");
	
//ÚLTIMO ALUNO
	$recMat = mysqli_prepare ($conexao,"SELECT matricula FROM usuario WHERE matricula like '9%' ORDER BY matricula DESC LIMIT 1");
	mysqli_stmt_execute($recMat);	
	mysqli_stmt_bind_result($recMat, $aMat);
	mysqli_stmt_fetch($recMat);
	
	if($aMat == null){
	   $aMat = 900000;}
	
	$aMat = $aMat + 1;
	$recMat = null;

//ÚLTIMO INSTRUTOR
	$recMat = mysqli_prepare ($conexao,"SELECT matricula FROM usuario WHERE matricula like '3%' ORDER BY matricula DESC LIMIT 1");
	mysqli_stmt_execute($recMat);	
	mysqli_stmt_bind_result($recMat, $iMat);
	mysqli_stmt_fetch($recMat);
	
	if($iMat == null){
	   $iMat = 300000;}
		
	$iMat = $iMat + 1;
	$recMat = null;

//ÚLTIMO GERENTE
	$recMat = mysqli_prepare ($conexao,"SELECT matricula FROM usuario WHERE matricula like '2%' ORDER BY matricula DESC LIMIT 1");
	mysqli_stmt_execute($recMat);	
	mysqli_stmt_bind_result($recMat, $gMat);
	mysqli_stmt_fetch($recMat);
	
	if($gMat == null){
	   $gMat = 200000;}
	   
	$gMat = $gMat + 1;

//FECHAR CONEXÃO	
	mysqli_stmt_close($recMat);

//INSTRUTORES	
	$rIns = mysqli_prepare ($conexao, "SELECT matricula FROM usuario WHERE nivel = 3");
	mysqli_stmt_execute($rIns);
	mysqli_stmt_bind_result($rIns, $fIns);
	mysqli_stmt_fetch($rIns);

	do{
		$oIns[] = $fIns;
	}while(mysqli_stmt_fetch($rIns));

	mysqli_stmt_close($rIns);
?>

<script src="js/jquery.mask.js"></script>
<script>
    $(document).ready(function () { 
        var $campoCpf = $("#alCpf");
        $campoCpf.mask('000.000.000-00', {reverse: true});
		
		var $campoCep = $("#alCep");
        $campoCep.mask('00000-000', {reverse: false});
		
		var $campoaTel = $("#alTele");
        $campoaTel.mask('(00) 00000-0000', {reverse: false});
		var $campogTel = $("#geTele");
        $campogTel.mask('(00) 00000-0000', {reverse: false});
		var $campoiTel = $("#inTele");
        $campoiTel.mask('(00) 00000-0000', {reverse: false});
		
		var $campoPes = $("#rpeso");
        $campoPes.mask('000.0', {reverse: true});
		
		var $campomSenha = $("#rcod");
        $campomSenha.mask('000000', {reverse: false});
		
	});
</script>

<!-- CADASTRAR ALUNO -->
<div class="container-fluid">
<div class="modal fade" id="cadAluno" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Cadastrar Aluno</h3>
        </div>
        <div class="modal-body">

		<form id="cdAluno" action="processa/prAluno.php" method="post">
	<!-- LINHA 1 -->
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="alMatr">Matrícula</label>
					<input type="text" class="form-control" id="alMatr" name="alMatr" readonly value="<?php echo $aMat; ?>">
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label for="alCpf">CPF*</label>
					<input type="text" class="form-control" id="alCpf" placeholder="000.000.000-00" name="alCpf" maxlength="11">
				</div>
			</div>
		</div>
	<!-- LINHA 2 -->
		<div class="row">
			<div class="col-md-10">
				<div class="form-group">
					<label for="alNome">Nome*</label>
					<input type="text" class="form-control" id="alNome" placeholder="Nome Completo" name="alNome" maxlength="80">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="alSexo">Sexo*</label>
					<select class="form-control" id="alSexo" name="alSexo">
						<option value="M">M</option>
						<option value="F">F</option>
					</select>
				</div>
			</div>
		</div>
	<!-- LINHA 3 -->
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label for="alMail">e-Mail</label>
					<input type="text" class="form-control" id="alMail" placeholder="endereco@dominio.com" name="alMail" maxlength="40">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="alTele">Telefone*</label>
					<input type="text" class="form-control" id="alTele" placeholder="(00) 99000-0000" name="alTele" maxlength="11">
				</div>
			</div>
		</div>
	<!-- LINHA 4 -->
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="alInst">Instrutor</label>
					<select class="form-control" id="alInst" name="alInst">
							<?php foreach($oIns as $ioption){?>
							<option value="<?php echo $ioption; ?>"><?php echo $ioption; ?></option>
							<?php };?>
					</select>
				</div>
			</div>
		</div>
	<!-- LINHA 5 -->
		<div class="row">
			<div class="col-md-10">
				<div class="form-group">
					<label for="alEnde">Endereço*</label>
					<input type="text" class="form-control" id="alEnde" placeholder="Logradouro" name="alEnde" maxlength="100">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="alNume">Número*</label>
					<input type="text" class="form-control" id="alNume" placeholder="Nº" name="alNume" maxlength="7">
				</div>
			</div>
		</div>
	<!-- LINHA 6 -->
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="alComp">Complemento</label>
					<input type="text" class="form-control" id="alComp" placeholder="Complemento" name="alComp" maxlength="80">
				</div>
			</div>
		</div>
	<!-- LINHA 7 -->
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="alCida">Cidade*</label>
					<input type="text" class="form-control" id="alCida" placeholder="Cidade" name="alCida" maxlength="60">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="alCep">CEP</label>
					<input type="text" class="form-control" id="alCep" placeholder="00000-000" name="alCep" maxlength="8">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="alEsta">Estado*</label>
					<select id="alEsta" name="alEsta" class="form-control">
						<option value="AC">Acre</option>
						<option value="AL">Alagoas</option>
						<option value="AP">Amapá</option>
						<option value="AM">Amazonas</option>
						<option value="BA">Bahia</option>
						<option value="CE">Ceará</option>
						<option value="DF" selected>Distrito Federal</option>
						<option value="ES">Espírito Santo</option>
						<option value="GO">Goiás</option>
						<option value="MA">Maranhão</option>
						<option value="MT">Mato Grosso</option>
						<option value="MS">Mato Grosso do Sul</option>
						<option value="MG">Minas Gerais</option>
						<option value="PA">Pará</option>
						<option value="PB">Paraíba</option>
						<option value="PR">Paraná</option>
						<option value="PE">Pernambuco</option>
						<option value="PI">Piauí</option>
						<option value="RJ">Rio de Janeiro</option>
						<option value="RN">Rio Grande do Norte</option>
						<option value="RS">Rio Grande do Sul</option>
						<option value="RO">Rondônia</option>
						<option value="RR">Roraima</option>
						<option value="SC">Santa Catarina</option>
						<option value="SP">São Paulo</option>
						<option value="SE">Sergipe</option>
						<option value="TO">Tocantins</option>
					</select>
				</div>
			</div>
		</div>
	<!-- LINHA 8 -->
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="alObs">Observações</label>
					<textarea class="form-control" id="alObs" placeholder="Observações" name="alObs" style="resize: none"  maxlength="100"></textarea>
				</div>
			</div>
		</div>
		<span>(*) Preenchimento Obrigatório</span>
	<!-- BOTÕES -->	
		<div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                    <button type="submit" id="alenviar" class="btn btn-success btn-hover-green" data-action="save" role="button"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registrar</button>
                </div>
				<div class="btn-group" role="group">
                    <button type="button" class="btn btn-info btn-hover-green" data-dismiss="modal"  role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Fechar</button>
                </div>
				<div class="btn-group" role="group">
                    <button type="reset" id="allimpar" class="btn btn-warning btn-hover-green" role="button"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Limpar</button>
                </div>
            </div>
        </div>
	</form>
    </div>
  </div>
</div>
</div>
</div>
<!-- FIM CADASTRAR ALUNO -->

<!-- CADASTRAR GERENTE -->
<div class="container-fluid">
<div class="modal fade" id="cadGerente" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Cadastrar Gerente</h3>
        </div>
        <div class="modal-body">

		<form  id="cdGerente" action="processa/prGerente.php" method="post">
		<!-- LINHA 1 -->
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="geMatr">Matrícula</label>
						<input type="text" class="form-control" id="geMatr" name="geMatr" readonly value="<?php echo $gMat; ?>">
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<label for="geNome">Nome*</label>
						<input type="text" class="form-control" id="geNome" placeholder="Nome Completo" name="geNome" maxlength="80">
					</div>
				</div>
			</div>
		<!-- LINHA 2 -->
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label for="geMail">e-Mail</label>
						<input type="text" class="form-control" id="geMail" placeholder="endereco@dominio.com" name="geMail" maxlength="40">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="geTele">Telefone*</label>
						<input type="text" class="form-control" id="geTele" placeholder="(00) 99000-0000" name="geTele" maxlength="11">
					</div>
				</div>
			</div>
		<!-- LINHA 3 -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="geObs">Observações</label>
						<textarea class="form-control" id="geObs" placeholder="Observações" name="geObs" style="resize: none" maxlength="100"></textarea>
					</div>
				</div>
			</div>
			<span>(*) Preenchimento Obrigatório</span>
		<!-- BOTÕES -->	
			<div class="modal-footer">
				<div class="btn-group btn-group-justified" role="group" aria-label="group button">
					<div class="btn-group" role="group">
						<button type="submit" id="geenviar" class="btn btn-success btn-hover-green" data-action="save" role="button"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registrar</button>
					</div>
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-info btn-hover-green" data-dismiss="modal"  role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Fechar</button>
					</div>
					<div class="btn-group" role="group">
						<button type="reset" id="gelimpar" class="btn btn-warning btn-hover-green" role="button"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Limpar</button>
					</div>
				</div>
			</div>
		</form>
		</div>
    </div>
  </div>
</div>
</div>
<!-- FIM CADASTRAR GERENTE -->

<!-- CADASTRAR INSTRUTOR -->
<div class="container-fluid">
<div class="modal fade" id="cadInstrutor" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Cadastrar Instrutor</h3>
        </div>
        <div class="modal-body">

		<form id="cdInstrutor" action="processa/prInstrutor.php" method="post">
	<!-- LINHA 1 -->
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="inMatr">Matrícula</label>
					<input type="text" class="form-control" id="inMatr" name="inMatr" readonly value="<?php echo $iMat; ?>">
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label for="inNome">Nome*</label>
					<input type="text" class="form-control" id="inNome" placeholder="Nome Completo" name="inNome" maxlength="80">
				</div>
			</div>
		</div>
	<!-- LINHA 2 -->
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label for="inMail">e-Mail</label>
					<input type="text" class="form-control" id="inMail" placeholder="endereco@dominio.com" name="inMail" maxlength="40">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="inTele">Telefone*</label>
					<input type="text" class="form-control" id="inTele" placeholder="(00) 99000-0000" name="inTele" maxlength="11">
				</div>
			</div>
		</div>
	<!-- LINHA 3 -->
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="inObs">Observações</label>
					<textarea class="form-control" id="inObs" placeholder="Observações" name="inObs" style="resize: none" maxlength="100"></textarea>
				</div>
			</div>
		</div>
		<span>(*) Preenchimento Obrigatório</span>
	<!-- BOTÕES -->	
		<div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                    <button type="submit" id="inenviar" class="btn btn-success btn-hover-green" data-action="save" role="button"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registrar</button>
                </div>
				<div class="btn-group" role="group">
                    <button type="button" class="btn btn-info btn-hover-green" data-dismiss="modal"  role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Fechar</button>
                </div>
				<div class="btn-group" role="group">
                    <button type="reset" id="inlimpar" class="btn btn-warning btn-hover-green" role="button"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Limpar</button>
                </div>
            </div>
        </div>
	</form>
    </div>
	</div>
</div>
</div>
</div>
<!-- FIM CADASTRAR INSTRUTOR -->

<!-- MODAL PESO -->
<div class="container-fluid">
<div class="modal fade" id="modalPeso" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Novo Peso</h3>
        </div>
        <div class="modal-body">

		<form action="processa/regpeso.php" method="post">
	<!-- LINHA 1 -->
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="rdata">Data</label>
					<input type="date" class="form-control" id="rdata" name="rdata" placeholder="aaaa/mm/dd">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="rpeso">Peso</label>
					<input type="decimal" class="form-control" id="rpeso" placeholder="Peso" name="rpeso" maxlength="5">
				</div>
			</div>
		</div>
	<!-- BOTÕES -->	
		<div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                    <button type="submit" class="btn btn-success btn-hover-green" data-action="save" role="button"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registrar</button>
                </div>
				<div class="btn-group" role="group">
                    <button type="button" class="btn btn-warning btn-hover-green" data-dismiss="modal"  role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Fechar</button>
                </div>
            </div>
        </div>
		</form>
		</div>
	</div>
  </div>
</div>
</div>
<!-- FIM MODAL PESO -->

<!-- MODAL SENHA -->
<div class="container-fluid">
<div class="modal fade" id="modalSenha" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Redefinir Senha</h3>
        </div>
        <div class="modal-body">

		<form action="processa/ressenha.php" method="post">
	<!-- LINHA 1 -->
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="rcod">Matrícula</label>
					<input type="text" class="form-control" id="rcod" name="rcod" placeholder="Matrícula">
				</div>
			</div>
		</div>
	<!-- BOTÕES -->	
		<div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                    <button type="submit" class="btn btn-success btn-hover-green" data-action="save" role="button" onclick="return confirm('DESEJA REALMENTE REDEFINIR A SENHA DESTE USUÁRIO?');"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Redefinir</button>
                </div>
				<div class="btn-group" role="group">
                    <button type="button" class="btn btn-warning btn-hover-green" data-dismiss="modal" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Fechar</button>
                </div>
            </div>
        </div>
		</form>
		</div>
	</div>
  </div>
</div>
</div>
<!-- FIM MODAL SENHA -->