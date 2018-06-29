<?php
//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	include_once("global/auth.php");
?>

<!doctype html>
<html lang="en">
	<head>
		<?php include_once("global/head.php");?>
		<title>Marombando</title>
	</head>
	
	<body class="bgimg">

		<?php include_once("menu.php");?>

		<div align="center">
			<h1>Bem vindo <?php echo $_SESSION['NOME'] ?></h1>
		</div>
		
		<div class="erromsg">
			<?php
				if (isset($_GET['m']))
				{
					echo $_GET['m'];
					$_GET['m'] = '';
				}
				?>
		</div>
		<div align="center">
			<?php include_once("central.php");?>
		</div>
	</body>
</html>

<?php
	include_once("forms/cadUsers.php");
	mysqli_close($conexao);
?>