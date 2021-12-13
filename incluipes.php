<?php 
// Verifica se existe as variáveis
if (isset($_GET["pessoa"])) {
	$pessoa = $_GET["pessoa"];
	$emppes = $_GET["emppes"];
	if (isset($_GET["tipdoc"])){
		$tipdoc = $_GET["tipdoc"];
		if (isset($_GET["numdoc"])){
			$numdoc = $_GET["numdoc"];
			if (isset($_GET["obs"])){
				$obs = $_GET["obs"];
			}
			echo ("chegou ate aqui incluipes.php");
			// Conexao com o banco de dados
			include("conexao.php");
			// Retira separadores do campo data atual
			$datahoje = preg_replace("/[^0-9]/", "", Date('Y-m-d'));
			$filial="";
			// Insere Pessoa 
			$sql1  = "INSERT INTO ZZ2 (ZZ2_FILIAL,ZZ2_NOMPES,ZZ2_TIPDOC,ZZ2_NUMDOC,ZZ2_EMPPES";
			$sql1 .= ",ZZ2_OBS,ZZ2_DATDIG,D_E_L_E_T_";
			$sql2  = " VALUES ('$filial','$pessoa','$tipdoc','$numdoc','$emppes','$obs','$datahoje',' '";
			
			if (isset($_GET["equipamento"])){
				$equipamento = $_GET["equipamento"];
				// busca na tabela ZZ3 a Placa
				$sql = "SELECT ZZ3_PLACA FROM ZZ3 WHERE ZZ3_IDEQU = '$equipamento'";
				$result = mysqli_query($cx,$sql);
				$aux    = mysqli_fetch_assoc($result); 
				$placa = $aux["ZZ3_PLACA"];
				$sql = $sql1 . ",ZZ2_IDEQU,ZZ2_PLACA)" . $sql2 . ",'$equipamento','$placa')";
			}else{
				$sql = $sql1 . ")" . $sql2 . ")";
			}
			$result = mysqli_query($cx,$sql);
			if ($result) {
				echo "Inclusao realizada com sucesso. ";
			}else {
				echo "Erro na inclusao. ";
			}
			
// daqui pra frente pode ser eliminado e puxado do pessoa.php				
			$sql = "SELECT ZZ2_IDPES,date_format(ZZ2_DATDIG,'%d/%m/%Y') ZZ2_DATDIG";
			$sql.= ",ZZ2_NOMPES,ZZ2_TIPDOC,ZZ2_NUMDOC,ZZ2_EMPPES,ZZ2_OBS";
			$sql.= ",ZZ2_IDEQU,ZZ2_PLACA";
			$sql.= ",ZZ3_IDEQU,ZZ3_PLACA,ZZ3_FROTA,ZZ3_EMPEQU,ZZ3_TIPEQU,ZZ3_POSSE";
			$sql.= " FROM ZZ2";
			$sql.= " LEFT JOIN ZZ3 ON ZZ2_IDEQU = ZZ3_IDEQU";
			$sql.= " WHERE ZZ2_NOMPES = '$pessoa'";
			$sql.= " ORDER BY ZZ2_IDPES DESC";
			sleep(1);
			$result = mysqli_query($cx,$sql);
			$cont   = mysqli_affected_rows($cx);
			// Verifica se a consulta retornou linhas 
			if ($cont > 0) {
				// Atribui o código HTML para montar uma tabel
				$return = '<table width="100%" border="2">';
				$return .= '<tr>';
				$return .= '<th align="center">Id</th>';
				$return .= '<th align="center">Pessoa</th>';
				$return .= '<th align="center">Tip Doc</th>';
				$return .= '<th align="center">Documento pessoa</th>';
				$return .= '<th align="center">Empresa pessoa</th>';
				$return .= '<th align="center">Placa</th>';
				$return .= '<th align="center">Frota</th>';
//				$return .= '<th align="center">EmpresaEquipa</th>';
//				$return .= '<th align="center">TipEquip</th>';
//				$return .= '<th align="center">Posse Equip</th>';
				$return .= '<th align="center">Observacoes</th>';
//				$return .= '<th align="center">Data Dig</th>';
				$return .= '<th align="center"></th>';
				$return .= '<th align="center"></th>';
				$return .= '</tr>';
				$return .= '<tbody>';
				// Captura os dados da consulta e insere na tabela HTML
				while($linha = mysqli_fetch_array($result)) { 
					$return .= '<tr>';
					$return .= '<td align="center"><font size="2">'.$linha["ZZ2_IDPES"].'</font></td>';
					$return .= '<td align="center"><font size="2">'.$linha["ZZ2_NOMPES"].'</font></td>';
					$return .= '<td align="center"><font size="2">'.$linha["ZZ2_TIPDOC"].'</font></td>';
					$return .= '<td align="center"><font size="2">'.$linha["ZZ2_NUMDOC"].'</font></td>';
					$return .= '<td align="center"><font size="2">'.$linha["ZZ2_EMPPES"].'</font></td>';
					$return .= '<td align="center"><font size="2">'.$linha["ZZ3_PLACA"].'</font></td>';
					$return .= '<td align="center"><font size="1">'.$linha["ZZ3_FROTA"].'</font></td>';
//					$return .= '<td align="center"><font size="2">'.$linha["ZZ3_EMPEQU"].'</font></td>';
//					$return .= '<td align="center"><font size="2">'.$linha["ZZ3_TIPEQU"].'</font></td>';
//					if ($linha["ZZ3_POSSE"]==1){
//						$return .= '<td align="center"><font size="2">'.'LINAVE'.'</font></td>';}
//					elseif ($linha["ZZ3_POSSE"]==2){
//						$return .= '<td align="center"><font size="2">'.'Cliente'.'</font></td>';			
//					}else{
//						$return .= '<td align="center"><font size="2">'.'Particular'.'</font></td>';			
//					}
					$return .= '<td align="center"><font size="2">'.$linha["ZZ2_OBS"].'</font></td>';
//					$return .= '<td align="center"><font size="2">'.$linha["ZZ2_DATDIG"].'</font></td>';
//					$return .= '<td align=center><a href=visualizapes.php?idpes='.$linha['ZZ2_IDPES'].'><img src=img/visualizar.png></a></td>';
					$return .= '<td align=center><a href=editapes.php?idpes='.$linha['ZZ2_IDPES'].'><img src=img/editar.png></a></td>';
					$return .= '<td align=center><a href=deleta.php?id='.$linha['ZZ2_IDPES'].'&tabdb=ZZ2&campo=IDPES'.'><img src=img/excluir.png></a></td>';
					$return .= '</tr>';
				}
				$return .= '</tbody></table>';
				echo $return;
			} else {
				// Se a consulta não retornar nenhum valor, exibi mensagem para o usuário
				echo "Movimento Não encontrado! ";
			}
// até aqui pode ser eliminado e puxado do pessoa.php				
		}
	}
}
?>	
