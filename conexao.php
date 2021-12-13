<!-- SMARV Informática MEI (91)98156-5857-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>	        
</head>

<body>
	<?php 
	$cx = new mysqli('localhost', 'root', '', 'datalin');
	//-- Checa a conexao
	if (mysqli_connect_errno())
	{
	echo "Falha ao connectar no MySQL: " . mysqli_connect_error();
		}
	?>	
</body>
</html>
<!-- SMARV Informática MEI (91)98156-5857-->