<?php
//CONECTAR NO BANCO DE DADOS	
	$conexao = mysqli_connect("localhost", "root", "","academia");
		
//VERIFICAR CONEXÃO	
	if (mysqli_connect_errno()){
		echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
		exit();
		}
//CODIFICAÇÃO
	mysqli_set_charset($conexao,"utf8")
?>