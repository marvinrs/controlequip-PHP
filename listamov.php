<?php

	$sql = "SELECT ZZ4_FILIAL,date_format(ZZ4_DATMOV,'%d/%m/%Y') ZZ4_DATMOV";
	$sql.= ",ZZ4_IDMOV,ZZ4_PORTAL,ZZ4_HORMOV,ZZ4_TIPMOV";
	$sql.= ",ZZ4_NOMPES,ZZ4_DOCPES,ZZ4_PLACA,ZZ4_FROTA,ZZ4_EMPEQU,ZZ4_TIPEQU";
	$sql.= ",ZZ4_FINALI,ZZ4_OBS,ZZ4_STATUS";
	$sql.= ",ZZ2_NOMPES,ZZ2_NUMDOC,ZZ2_EMPPES,ZZ3_PLACA,ZZ3_FROTA,ZZ3_EMPEQU";
	$sql.= ",ZZ3_TIPEQU,ZZ5_FINALI,ZZ4_EMBARC";
	$sql.= ",CASE WHEN ZZ4_DESLOC='1' THEN 'Belem'";
	$sql.= "      WHEN ZZ4_DESLOC='2' THEN 'Manaus'";
	$sql.= "	  WHEN ZZ4_DESLOC='3' THEN 'Santarem'";
	$sql.= "	  WHEN ZZ4_DESLOC='4' THEN 'Trombetas'";
	$sql.= "      WHEN ZZ4_DESLOC='5' THEN 'Cliente'";
	$sql.= "      WHEN ZZ4_DESLOC='6' THEN 'Fornecedor'";
	$sql.= "	  WHEN ZZ4_DESLOC='7' THEN 'Outros'";
	$sql.= " END ZZ4_DESLOC";
	$sql.= " FROM ZZ4 ZZ4";
	$sql.= " LEFT JOIN ZZ2 ON ZZ4_IDPES = ZZ2_IDPES";
	$sql.= " LEFT JOIN ZZ3 ON ZZ4_IDEQU = ZZ3_IDEQU";
	$sql.= " LEFT JOIN ZZ5 ON ZZ4_FINALI = ZZ5_ID";
	$sql.= " WHERE ZZ4.D_E_L_E_T_ <> '*'";
	$sql.= " AND ZZ4_FILIAL = '$filial'";
	$sql.= " AND ZZ4_PORTAL = '$portal'";
	$sql.= " AND ZZ4_DATMOV = '$DataMov_1'";
	$sql.= " ORDER BY ZZ4_IDMOV DESC";
	sleep(1);
	$result = mysqli_query($cx,$sql);
	$cont   = mysqli_affected_rows($cx);
	// Verifica se a consulta retornou linhas 
	if ($cont > 0) {
		// Atribui o código HTML para montar uma tabel
		$return = '<table width="100%" border="1">';
		$return .= '<tr>';
		$return .= '<th style="font-size:12px" align="center">Id</th>';
	//	$return .= '<th style="font-size:12px" align="center">Portal</th>';
		$return .= '<th style="font-size:12px" align="center">Data</th>';
		$return .= '<th style="font-size:12px" align="center">Hora</th>';
		$return .= '<th style="font-size:12px" align="center">Tipo</th>';
		$return .= '<th style="font-size:12px" align="center">Pessoa</th>';
	//	$return .= '<th style="font-size:12px" align="center">Identificacao</th>';
	//	$return .= '<th style="font-size:12px" align="center">EmpresaPessoa</th>';
		$return .= '<th style="font-size:12px" align="center">Placa</th>';
		$return .= '<th style="font-size:12px" align="center">Frota</th>';
	//	$return .= '<th style="font-size:12px" align="center">EmpresaEquipa</th>';
		$return .= '<th style="font-size:12px" align="center">TipEquip</th>';
		if ($portal == '2') {
			$return .= '<th style="font-size:12px" align="center">Balsa</th>';
			$return .= '<th style="font-size:12px" align="center">Ori/Dest</th>';
		}else{
			$return .= '<th style="font-size:12px" align="center">Finalidade</th>';
		}
	//	$return .= '<th style="font-size:12px" align="center">Observacoes</th>';
		$return .= '<th style="font-size:12px" align="center"></th>';
		$return .= '<th style="font-size:12px" align="center"></th>';
		$return .= '</tr>';
		$return .= '<tbody>';
		// Captura os dados da consulta e insere na tabela HTML
		while($linha = mysqli_fetch_array($result)) { 
			$return .= '<tr>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ4_IDMOV"].'</td>';
	//		$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ4_PORTAL"].'</td>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ4_DATMOV"].'</td>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ4_HORMOV"].'</td>';
			if ($linha["ZZ4_TIPMOV"]==1){
				$return .= '<td style="font-size:12px" align="center">'.'Chegada'.'</td>';}
			elseif ($linha["ZZ4_TIPMOV"]==2){
				$return .= '<td style="font-size:12px" align="center">'.'Saida'.'</td>';			
			}else{
				$return .= '<td style="font-size:12px" align="center">'.'Outros'.'</td>';			
			}
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ2_NOMPES"].'</td>';
	//		$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ2_NUMDOC"].'</td>';
	//		$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ2_EMPPES"].'</td>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ3_PLACA"].'</td>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ3_FROTA"].'</td>';
	//		$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ3_EMPEQU"].'</td>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ3_TIPEQU"].'</td>';
			if ($portal == '2') {
				$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ4_EMBARC"].'</td>';
				$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ4_DESLOC"].'</td>';
			}else{
				$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ5_FINALI"].'</td>';
			}	
	//		$return .= '<td align="left"  >'.$linha["ZZ4_OBS"].'</td>';
	//		if ($linha["ZZ4_TIPMOV"]==1){
	//			$return .= '<th style="font-size:12px" align="center">'.'Patio'.'</td>';
	//		}
	//		elseif ($linha["ZZ4_TIPMOV"]==2){
	//			$return .= '<th style="font-size:12px" align="center">'.'Transito'.'</td>';			
	//		}
	//		else{
	//			$return .= '<th style="font-size:12px" align="center">'.'Outros'.'</td>';
	//		}
			$return .= '<td align=center><a href=visualizamov.php?idmov='.$linha['ZZ4_IDMOV'].'><img src=img/visualizar.png></a></td>';
			$return .= '<td align=center><a href=editamov.php?idmov='.$linha['ZZ4_IDMOV'].'><img src=img/editar.png></a></td>';
			$return .= '<td align=center><a href=deleta.php?id='.$linha['ZZ4_IDMOV'].'&tabdb=ZZ4&campo=IDMOV'.'><img src=img/excluir.png></a></td>';
			$return .= '</tr>';
		}
		echo $return .= '</tbody></table>';
	} else {
		// Se a consulta não retornar nenhum valor, exibe mensagem para o usuário
		echo "Movimento Não encontrado! ";
	}
?>