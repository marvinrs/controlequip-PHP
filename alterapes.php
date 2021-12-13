<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Altera Pessoa</title>
</head>
<body background="background="clouds.gif"">	
	<?php
		// conexao com o banco de dados
		include("conexao.php");
		// transfere as variaveis get para o php 
		$id		= $_GET["id"];
		$nompes  = $_GET["nompes"];
		$tipdoc  = $_GET["tipdoc"];
		$numdoc = $_GET["numdoc"];
		$emppes  = $_GET["emppes"];
		$obs = $_GET["obs"];
		$idequ	= $_GET["idequ"];
		//Aqui $cx é referente ao código conexao.php;
		$sql  = "UPDATE ZZ2 LEFT JOIN ZZ3 ON ZZ3.ZZ3_IDEQU=ZZ2.ZZ2_IDEQU SET";
		$sql .= " ZZ2_NOMPES= '$nompes'";
		$sql .= ",ZZ2_TIPDOC= '$tipdoc'";
		$sql .= ",ZZ2_NUMDOC= '$numdoc'";
		$sql .= ",ZZ2_EMPPES= '$emppes'";
		$sql .= ",ZZ2_OBS	= '$obs'";
		$sql .= ",ZZ2_IDEQU = '$idequ'";
		$sql .= ",ZZ2_PLACA = ZZ3.ZZ3_PLACA";
		$sql .= " WHERE ZZ2_IDPES ='$id'";
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