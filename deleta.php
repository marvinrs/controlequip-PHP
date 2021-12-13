<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exclui cadastro</title>
</head>
<body background="background="clouds.gif"">	
	<?php
		include("conexao.php");
		$id  = $_GET["id"];
		$tabdb = $_GET["tabdb"];
		$campo = $_GET["campo"];
		echo $id.' '.$tabdb.' '.$campo;
		//Aqui $cx é referente ao código conexao.php;
		if ($tabdb == "ZZ4"):
			$deleta = mysqli_query($cx,"UPDATE ".$tabdb." SET D_E_L_E_T_='*' WHERE ".$tabdb."_".$campo."='$id'");
		else:
			// verifica se registro a ser deletado está relacionado a registro do movimento
			$sql = "SELECT * FROM ZZ4 WHERE ZZ4_".$campo."='$id'";
			echo $sql;
			$result = mysqli_query($cx,$sql);
			$cont   = mysqli_affected_rows($cx);
			if ($cont > 0) {
				echo "<script>
							alert('Registro não pode ser excluido porque existe movimento de chegada ou saida');
							window.history.back();
					</script>";
					return;
			}else{
				$sql = "DELETE FROM ".$tabdb." WHERE ".$tabdb."_".$campo."='$id'";
				echo $sql;
				$deleta = mysqli_query($cx,$sql);
			}
		endif;
		if($deleta):
			echo "<script>
						alert('Exclusao realizada com sucesso.');
						window.history.back();
				</script>";
		else:
			echo "<script>
					alert('Não foi possível excluir.');
					window.history.back();
				</script>";
		endif;
	?>
	
</body>
</html>
<!-- SMARV Informática MEI (91)98156-5857-->