<?php
//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
	include_once("global/auth.php");
//BUSCAR DADOS DO GRÁFICO
	include_once("global/cselect.php");
?>

<!doctype html>
<html>
	<head>
		<?php include_once("global/head.php");?>
		<title>Marombando</title>
	</head>
	
	<body class="bgimg">

		<?php include_once("menu.php");?>

		<div align="center">
			<h1>Resumo</h1>
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
	
<div class="container-fluid">
	<div style="margin: 3%" class="container-fluid">
		<div class="row">
			<div class="col-md-3" >
				<h2 class="simplemsg"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Geral</h2>
				<h4><span class="simplemsg"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>  Instrutor:  </span><span><?php echo $nomeINS ?></span></h4>
				<h4><span class="simplemsg"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Última Avaliação: </span><span><?php echo $dataAV ?></span></h4>
				<h4><span class="simplemsg" style="color:#3f6796"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Enviar Mensagem</span></h4>
				</br>
			</div>
			<div class="col-md-6" >
				<h2 class="simplemsg"><span class="glyphicon glyphicon-scale" aria-hidden="true"></span> Pesagem</h2>
				<div>
				<h4><span class="simplemsg"><span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span> Atual: </span><span><?php echo $_SESSION['ULTPESO']." kg" ?></span></h4>
				<h4><span class="simplemsg"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Em: </span><span><?php echo $_SESSION['ULTDATA'] ?></span></h4>
				<h4><span class="simplemsg" style="color:#3f6796">
					<a data-toggle="modal" href="#modalPeso">
						<span class="glyphicon glyphicon-plus" aria-hidden="true" ></span> Novo Peso</a>
					</span>
				</h4>
				</div>
				<div id="chartContainer" style="height: 350px; padding: 0px"></div>
				</br>
			</div>
			<div class="col-md-3">
				<h2 class="simplemsg"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Medidas</h2>
				<h4><span class="simplemsg"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Altura: </span><span><?php echo "1.73"."m" ?></span></h4>
				<div align="center">

				<img src="images/silhueta.png">
				</div>
			</div>
		</div>
	</div>
</div>

<!--GRÁFICO-->	
		<script type="text/javascript">
			//GRÁFICO
				//VARIÁVEIS COM VALORES DO GRÁFICO - DE PHP PARA JS
			//PESO
				var p = <?php echo json_encode($peso); ?>;
			//DIA
				var dD = <?php echo json_encode($dataD); ?>;
			//MES
				var dM = <?php echo json_encode($dataM); ?>;
			//ANO
				var dA = <?php echo json_encode($dataA); ?>;
			//CONTAR TAMANHO DO ARRAY
				var pT = p.length;
			//AJUSTAR MÊS PARA EXIBIÇÃO NO GRÁFICO
				for( var i = 0; i < pT; i++ ){
					dM[i] = dM[i] - 1;
				}
			//DEFINIR VALOR MÍNIMO E MÁXIMO DO GRÁFICO
				var cMX = Math.max(...p);
				var cMN = Math.min(...p);
				cMX = cMX + 2;
				cMN = cMN - 2;
			//IMPRIMIR PONTOS NO GRÁFICO	
				var dataPoints = [];
				var y = 0;
				var x = 0;
				for( var i = 0; i < pT; i++ )
					{dataPoints.push({ x: new Date(Number(dA[i]), Number(dM[i]), Number(dD[i])), y : Number(p[i]) });}
			//DEFINIR LAYOUT E DESENHAR GRÁFICO
				window.onload = function () {
				var chart = new CanvasJS.Chart("chartContainer",
				{
					backgroundColor: null,
					
					axisX:{
						valueFormatString: "MMM",
						interval: 1,
						intervalType: "month"
					},
					theme: "theme2",
					axisY:{
						interval: 2,
						minimum: cMN,
						maximum: cMX
					},
					data: [
					  {
						type: "area",
						lineThickness: 4,
						fillOpacity: 0.6,
						dataPoints: dataPoints
					  }
					]
				});
				chart.render();
				}
			//FIM DO GRÁFICO
		</script>
		<script src="processa/canvasjs.min.js"></script>
<!--GRÁFICO-->

	</body>
</html>

<?php
	include_once("forms/cadUsers.php");
	mysqli_close($conexao);
?>

