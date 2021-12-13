<?php 
// Verifica se existe a variável GET
if (isset($_GET["pessoa"])) {
    $pessoa = $_GET["pessoa"];
	// Conexao com o banco de dados
	include("conexao.php");
 // Verifica se a variável está vazia
    if (empty($pessoa)) {
        echo "";
    } else {

		$sql  = "SELECT ZZ2_IDPES,date_format(ZZ2_DATDIG,'%d/%m/%Y') ZZ2_DATDIG";
		$sql .= ",ZZ2_NOMPES,ZZ2_TIPDOC,ZZ2_NUMDOC";
		$sql .= ",ZZ2_EMPPES,ZZ2_OBS,ZZ2_PLACA";
		$sql .= ",ZZ3_FROTA,ZZ3_EMPEQU,ZZ3_TIPEQU,ZZ3_POSSE";
		$sql .= " FROM ZZ2";
		$sql .= " LEFT JOIN ZZ3 ON ZZ2_PLACA = ZZ3_PLACA";
		$sql .= " WHERE ZZ2_NOMPES LIKE '%$pessoa%'";
		$sql .= " ORDER BY ZZ2_NOMPES";
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
			$return .= '<th align="center">TipDoc</th>';
			$return .= '<th align="center">DocumentoPessoa</th>';
			$return .= '<th align="center">Empresapessoa</th>';
			$return .= '<th align="center">Placa</th>';
			$return .= '<th align="center">Frota</th>';
//			$return .= '<th align="center">EmpresaEquipa</th>';
//			$return .= '<th align="center">TipEquip</th>';
//			$return .= '<th align="center">Posse Equip</th>';
			$return .= '<th align="center">Observacoes</th>';
//			$return .= '<th align="center">DataDig</th>';
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
				$return .= '<td align="center"><font size="2">'.$linha["ZZ2_PLACA"].'</font></td>';
				$return .= '<td align="center"><font size="1">'.$linha["ZZ3_FROTA"].'</font></td>';
//				$return .= '<td align="center"><font size="2">'.$linha["ZZ3_EMPEQU"].'</font></td>';
//				$return .= '<td align="center"><font size="2">'.$linha["ZZ3_TIPEQU"].'</font></td>';
//				if ($linha["ZZ3_POSSE"]==1){
//					$return .= '<td align="center"><font size="2">'.'Cliente'.'</font></td>';}
//				elseif ($linha["ZZ3_POSSE"]==2){
//				$return .= '<td align="center"><font size="2">'.'Fornecedor'.'</font></td>';}			
//				elseif ($linha["ZZ3_POSSE"]==3){
//				$return .= '<td align="center"><font size="2">'.'Froprio'.'</font></td>';}		
//				elseif ($linha["ZZ3_POSSE"]==4){
//				$return .= '<td align="center"><font size="2">'.'LINAVE'.'</font></td>';		
//				}else{
//					$return .= '<td align="center"><font size="2">'.'OUTROS'.'</font></td>';			
//				}
				$return .= '<td align="center"><font size="2">'.$linha["ZZ2_OBS"].'</font></td>';
//				$return .= '<td align="center"><font size="2">'.$linha["ZZ2_DATDIG"].'</font></td>';
//				$return .= '<td align=center><a href=visualizapes.php?idpes='.$linha['ZZ2_IDPES'].'><img src=img/visualizar.png></a></td>';
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
   }
}
?>	