<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Altera Movimento</title>
</head>
<body background="background="clouds.gif"">	
	<?php
		// conexao com o banco de dados
		include("conexao.php");
		// transfere as variaveis get para o php 
		$id		= $_GET["id"];
		$tipmov = $_GET["tipmov"];
		$pessoa = $_GET["pessoa"];
		$placa  = $_GET["placa"];
		$finali = $_GET["finali"];
		$embarc = $_GET["embarcacao"];
		$desloc = $_GET["deslocamento"];
		$obs	= $_GET["obs"];
		//Aqui $cx é referente ao código conexao.php;
		$sql  = "UPDATE ZZ4 SET";
		$sql .= " ZZ4_TIPMOV = '$tipmov'";
		$sql .= ",ZZ4_FINALI = '$finali'";
		$sql .= ",ZZ4_EMBARC = '$embarc'";
		$sql .= ",ZZ4_DESLOC = '$desloc'";
		$sql .= ",ZZ4_OBS 	 = '$obs'";
		$sql .= ",ZZ4_IDPES  = '$pessoa'";
		$sql .= ",ZZ4_IDEQU  = '$placa'";
		$sql .= " WHERE ZZ4_IDMOV ='$id'";
		$altera = mysqli_query($cx,$sql);
		if($altera):
			echo nl2br("ALTERAÇÃO REALIZADA COM SUCESSO \n");
		else:
			echo nl2br("NÃO FOI POSSIVEL ALTERAR \n");
		endif;
		echo $return ='<input type="button" value="Voltar" onClick="history.go(-1)" align="center">';
	?>
	
</body>
</html>
<!-- SMARV Informática MEI (91)98156-5857-->