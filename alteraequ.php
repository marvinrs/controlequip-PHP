<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Altera Equipamento</title>
</head>
<body background="background="clouds.gif"">	
	<?php
		// conexao com o banco de dados
		include("conexao.php");
		// transfere as variaveis get para o php 
		$id		= $_GET["id"];
		$placa  = $_GET["placa"];
		$frota  = $_GET["frota"];
		$tipequ = $_GET["tipequ"];
		$posse  = $_GET["posse"];
		$empequ = $_GET["empequ"];
		$obs	= $_GET["obs"];
		//Aqui $cx é referente ao código conexao.php;
		$sql  = "UPDATE ZZ3 SET";
		$sql .= " ZZ3_PLACA  = '$placa'";
		$sql .= ",ZZ3_FROTA = '$frota'";
		$sql .= ",ZZ3_TIPEQU = '$tipequ'";
		$sql .= ",ZZ3_POSSE  = '$posse'";
		$sql .= ",ZZ3_EMPEQU = '$empequ'";
		$sql .= ",ZZ3_OBS 	 = '$obs'";
		$sql .= " WHERE ZZ3_IDEQU ='$id'";
		$altera = mysqli_query($cx,$sql);
			echo nl2br("************************************* \n");
		if($altera):
			echo nl2br("ALTERAÇÃO REALIZADA COM SUCESSO \n");
		else:
			echo nl2br("NÃO FOI POSSIVEL ALTERAR \n");
		endif;
			echo nl2br("************************************* \n");
	?>
	
</body>
</html>
<!-- SMARV Informática MEI (91)98156-5857-->