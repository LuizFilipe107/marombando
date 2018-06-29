<?php
//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	include_once("global/auth.php");
?>

<!doctype html>
<html>
	<head>
		<?php include_once("global/head.php");?>
		<title>Seus Alunos</title>
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
			<h1 style="text-align:center">Seus Alunos</h1>
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
	$insAlunos = $rMat = $rNom = $rMail = $rAtiv = $rInst = $rObs = null;
	$insAlunos = mysqli_prepare($conexao,"SELECT u.matricula, u.nome, u.email, u.ativo, a.instrutor, u.obs 
										FROM usuario u, aluno a WHERE u.matricula LIKE '9%' AND a.mtuser = u.matricula AND a.instrutor = ? ORDER BY u.matricula");
	mysqli_stmt_bind_param($insAlunos,'i', $_SESSION['MATRICULA']);
	mysqli_stmt_execute($insAlunos);
	mysqli_stmt_bind_result($insAlunos, $rMat, $rNom, $rMail, $rAtiv, $rInst, $rObs);
	mysqli_stmt_fetch($insAlunos);
?>	

<!-------------------TABELA RESULTADO-------------------->
<div class="container-fluid">
	<div class="table-responsive">
		<table class="table table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th>Matrícula</th>
					<th>Nome</th>
					<th>e-mail</th>
					<th>Ativo</th>
					<th>Instrutor</th>
					<th>Observação</th>
					<th colspan="4" style="text-align:center">Ações</th>
				</tr>
			</thead>
		<?php do{ ?>
			<tbody>
				<tr>
					<td <?php if($rAtiv==0){echo "bgcolor='#ffdeed'";};?>><?php echo $rMat; if(!$rMat){echo "-";};?></td>
					<td <?php if($rAtiv==0){echo "bgcolor='#ffdeed'";};?>><?php echo $rNom; if(!$rNom){echo "-";};?></td>
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
							<span class="glyphicon glyphicon-scale" aria-hidden="true" style="color:#bbb1b3;"></span>
						<?php }else{ ?>
							<a href="iresumo.php?c=<?php echo $rMat; ?>" data-toggle="tooltip" title="Resumo"><span class=" glyphicon glyphicon-scale" aria-hidden="true" style="color:black;"></span></a>
						<?php }; ?>
					</td>
		
					<td style="text-align:center" <?php if($rAtiv==0){echo "bgcolor='#ffdeed'";};?>>
						<?php if(!$rMat){?>
							<span class="glyphicon glyphicon-envelope" aria-hidden="true" style="color:#bbb1b3;"></span>
						<?php }else{ ?>
							<a href="#" title="Mensagem"><span class="glyphicon glyphicon-envelope" aria-hidden="true" style="color:black;" data-toggle="tooltip" title="Mensagem"></span></a>	
						<?php }; ?>
					</td>
					
					<td style="text-align:center" <?php if($rAtiv==0){echo "bgcolor='#ffdeed'";};?>>
						<?php if(!$rMat){?>
							<span class="glyphicon glyphicon-copy" aria-hidden="true" style="color:#bbb1b3;"></span>
						<?php }else{ ?>
							<a href="avaliacao.php?c=<?php echo $rMat; ?>" data-toggle="tooltip" title="Avaliação"><span class=" glyphicon glyphicon-copy" aria-hidden="true" style="color:black;"></span></a>
						<?php }; ?>
					</td>

				</tr>
			<?php }while(mysqli_stmt_fetch($insAlunos)); ?>
			</tbody>
		</table>
	</div>	
</div>	
</body>

</html>

<?php
	mysqli_stmt_close($insAlunos);
	mysqli_close($conexao);
?>

