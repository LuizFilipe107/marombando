<?php
//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	include_once("global/auth.php");
	
	if(!($_SESSION['NIVEL'] == 1 OR $_SESSION['NIVEL'] == 2)){
		$msg = "Você não tem permissão para acessar essa área";
		header("Location: principal.php?m=$msg");
	};
	
?>

<!doctype html>
<html>
	<head>
		<?php include_once("global/head.php");?>
		<title>Alunos Cadastrados</title>
	</head>

<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();   
});
</script>
	
<body class="bgimg">
		<?php include_once("menu.php");?>
		
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1 style="text-align:center">Alunos Cadastrados</h1>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-md-12">
			<button type="button" id="cadger" class="btn btn-info btn-lg center-block" data-toggle="modal" data-target="#cadAluno">Cadastrar Aluno</button>
		</div>
	</div>
</div>
<!-------------------ERRO-------------------->
	<div class="erromsg">
		<?php
			if (isset($_GET['m']))
			{
			echo $_GET['m'];
			$_GET['m'] = '';
			}
		?>
	</div>
<!-------------------CONEXÃO BD-------------------->
<?php 
		//CONECTAR NO BANCO DE DADOS
		include_once("global/banco.php");

		//3.3 CRIAR O SCRIPT SQL
	$alStmt = mysqli_prepare($conexao,"SELECT u.matricula, u.nome, a.cpf, u.email, u.ativo, a.instrutor, u.obs FROM usuario u, aluno a WHERE u.matricula LIKE '9%' AND a.mtuser = u.matricula ORDER BY u.matricula");
								
	mysqli_stmt_execute($alStmt);	
	mysqli_stmt_bind_result($alStmt, $rMat, $rNom, $rCpf, $rMail, $rAtiv, $rInst, $rObs);
	mysqli_stmt_fetch($alStmt);
?>	

<!-------------------TABELA RESULTADO-------------------->
<div class="container-fluid">
	<div class="table-responsive">
		<table class="table table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th>Matrícula</th>
					<th>Nome</th>
					<th>CPF</th>
					<th>e-mail</th>
					<th>Ativo</th>
					<th>Instrutor</th>
					<th>Observação</th>
					<th colspan="3" style="text-align:center">Ações</th>
				</tr>
			</thead>
		<?php do{ ?>
			<tbody>
				<tr>
					<td <?php if($rAtiv==0){echo "bgcolor='#ffdeed'";};?>><?php echo $rMat; if(!$rMat){echo "-";};?></td>
					<td <?php if($rAtiv==0){echo "bgcolor='#ffdeed'";};?>><?php echo $rNom; if(!$rNom){echo "-";};?></td>
					<td <?php if($rAtiv==0){echo "bgcolor='#ffdeed'";};?>><?php echo $rCpf; if(!$rCpf){echo "-";};?></td>
					<td <?php if($rAtiv==0){echo "bgcolor='#ffdeed'";};?>><?php echo $rMail; if(!$rMail){echo "-";};?></td>
					<td <?php if($rAtiv==0){echo "bgcolor='#ffdeed'";};?>><?php 
						if(!$rMat){
							echo "-";
						}elseif($rAtiv==1){
							echo "Sim";
						}else{echo "Não";
						}?></td>
					<td <?php if($rAtiv==0){echo "bgcolor='#ffdeed'";};?>><?php echo $rInst; if(!$rInst){echo "-";};?></td>
					<td <?php if($rAtiv==0){echo "bgcolor='#ffdeed'";};?>><?php echo $rObs; if(!$rObs){echo "-";};?></td>
					<td style="text-align:center" <?php if($rAtiv==0){echo "bgcolor='#ffdeed'";};?>>
						<?php if(!$rMat){?>
							<span class="glyphicon glyphicon-list-alt" aria-hidden="true" style="color:#bbb1b3;"></span>
						<?php }else{ ?>
							<a href="visualizaA.php?c=<?php echo $rMat; ?>" data-toggle="tooltip" title="Dados"><span class="glyphicon glyphicon-list-alt" aria-hidden="true" style="color:black;"></span></a>
						<?php }; ?>
					</td>
					<td style="text-align:center" <?php if($rAtiv==0){echo "bgcolor='#ffdeed'";};?>>
						<?php if(!$rMat){?>
							<span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color:#bbb1b3;"></span>
						<?php }else{ ?>
							<a href="editaA.php?c=<?php echo $rMat; ?>" data-toggle="tooltip" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color:black;"></span></a>	
						<?php }; ?>
					</td>
					<td style="text-align:center" <?php if($rAtiv==0){echo "bgcolor='#ffdeed'";};?>>
						<?php if(!$rMat){?>
							<span class="glyphicon glyphicon-trash" aria-hidden="true" style="color:#bbb1b3;"></span>
						<?php }else{ ?>
							<a href="processa/cExcluir.php?c=<?php echo $rMat; ?>" onclick="return confirm('DESEJA REALMENTE EXCLUIR \n\n<?php echo $rNom; ?>?\n\nESTA AÇÃO NÃO PODE SER DESFEITA');" data-toggle="tooltip" title="Excluir"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color:black;"></span></a>	
						<?php }; ?>
					</td>
				</tr>
			<?php }while(mysqli_stmt_fetch($alStmt)); ?>
			</tbody>
		</table>
	</div>	
</div>	
</body>

</html>

<?php
	include_once("forms/cadUsers.php");
	mysqli_stmt_close($alStmt);
	mysqli_close($conexao);
?>

