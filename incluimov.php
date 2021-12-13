<?php
// Verifica se usuario logado
include("verifica.php");
// Verifica se existe as variáveis
if (isset($_GET["DataMov"])) {
    $DataMov = $_GET["DataMov"];
	$tipmov = $_GET["tipmov"];
	if (isset($_GET["hora"])){
		$hora = $_GET["hora"];
		if (isset($_GET["finalidade"])){
			$finalidade = $_GET["finalidade"];
			if (isset($_GET["pessoa"])){
				$pessoa = $_GET["pessoa"];
				if (isset($_GET["obs"])){
					$obs = $_GET["obs"];
				}
				$embarc = $_GET["embarcacao"];
				$desloc = $_GET["deslocamento"];
 				// Conexao com o banco de dados
				include("conexao.php");
				// Retira separadores do campo data
				$DataMov_1 = preg_replace("/[^0-9]/", "", $DataMov);
				// Insere Pessoa primeira  parte da query de insercao
				$sql1  = "INSERT INTO ZZ4 (ZZ4_FILIAL,ZZ4_PORTAL,ZZ4_DATMOV,ZZ4_HORMOV,ZZ4_TIPMOV";
				$sql1 .= ",ZZ4_IDPES,ZZ4_FINALI,ZZ4_OBS,ZZ4_STATUS,ZZ4_EMBARC,ZZ4_DESLOC,D_E_L_E_T_";
				$status = "1";
				// segunda parte da query de insercao
				$sql2 = " VALUES ('$filial','$portal','$DataMov_1','$hora','$tipmov','$pessoa','$finalidade','$obs','$status','$embarc','$desloc',' '";
				$flag = 0;
				if (isset($_GET["equipamento"])){
					$equipamento = $_GET["equipamento"];
					$sql = $sql1 . ",ZZ4_IDEQU)" . $sql2 . ",'$equipamento')";
					$result = mysqli_query($cx,$sql);
					$flag = 1;
					if ($result) {
						echo " ";
					}else {
						echo "erro na inclusao de movimento de equipamento. ";
					}
				}
				/*else{
					$result = mysqli_query($cx,"SELECT ZZ3_IDEQU FROM ZZ2 INNER JOIN ZZ3 ON ZZ3_IDEQU=ZZ2_IDEQU WHERE ZZ2_IDPES='$pessoa'");
					$cont= mysqli_affected_rows($cx);
					if ($cont > 0) {
						$aux = mysqli_fetch_assoc($result);
						$equipamento = $aux["ZZ3_IDEQU"];
						$sql = $sql1 . ",ZZ4_IDEQU)" . $sql2 . ",'$equipamento')";
						$result = mysqli_query($cx,$sql);
						$flag = 1;
						if ($result) {
							echo " ";
						}else {
							echo "erro na inclusao de movimento de equipamento. ";
						}
					}
				} */
				if (isset($_GET["equipamento2"])){
					$equipamento2 = $_GET["equipamento2"];
					$sql = $sql1 . ",ZZ4_IDEQU)" . $sql2 . ",'$equipamento2')";
					$result = mysqli_query($cx,$sql);
					$flag = 1;
					if ($result) {
						echo " ";
					}else {
						echo "erro na inclusao movimento de equipamento2. ";
					}
				}
				if (isset($_GET["equipamento3"])){
					$equipamento3 = $_GET["equipamento3"];
					$sql = $sql1 . ",ZZ4_IDEQU)" . $sql2 . ",'$equipamento3')";
					$result = mysqli_query($cx,$sql);
					$flag = 1;
					if ($result) {
						echo " ";
					}else {
						echo "erro na inclusao de movimento de equipamento3. ";
					}
				}
				if (isset($_GET["equipamento4"])){
					$equipamento4 = $_GET["equipamento4"];
					$sql = $sql1 . ",ZZ4_IDEQU)" . $sql2 . ",'$equipamento4')";
					$result = mysqli_query($cx,$sql);
					$flag = 1;
					if ($result) {
						echo " ";
					}else {
						echo "erro na inclusao de mocimento de equipamento4. ";
					}
				}
				if ($flag == 0) {
					$sql = $sql1 . ")" . $sql2 . ")";
					$result = mysqli_query($cx,$sql);
					if ($result) {
						echo " ";
					}else {
						echo "erro na inclusao de movimento de pessoa. ";
					}
				}
				// alterado para trazer a rotina que lista o movimento de um dia
				include("listamov.php");
			}	
		}
	}
}
?>	
