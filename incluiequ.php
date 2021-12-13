<?php 
// Verifica se existe as variáveis
if (isset($_GET["placa"])) {
	$placa = $_GET["placa"];
	$frota = $_GET["frota"];
	$empequ = $_GET["empequ"];
	if (isset($_GET["tipequ"])){
		$tipequ = $_GET["tipequ"];
		if (isset($_GET["posse"])){
			$posse = $_GET["posse"];
			if (isset($_GET["obs"])){
				$obs = $_GET["obs"];
			}
			// Conexao com o banco de dados
			include("conexao.php");
			// Retira separadores do campo data atual
			$datahoje = preg_replace("/[^0-9]/", "", Date('Y-m-d'));
			$filial="";
			// Insere placa 
			$sql  = "INSERT INTO ZZ3 (ZZ3_PLACA,ZZ3_FROTA,ZZ3_TIPEQU,ZZ3_POSSE";
			$sql .= ",ZZ3_EMPEQU,ZZ3_OBS,ZZ3_DATDIG,D_E_L_E_T_)";
			$sql .= " VALUES ('$placa','$frota','$tipequ','$posse','$empequ','$obs','$datahoje',' ')";
			$result = mysqli_query($cx,$sql);
			if ($result) {
				echo "INCLUSAO REALIZADA COM SUCESSO. ";
			}else {
// daqui pra frente pode ser eliminado e puxado do equipamento.php				
				$sql  = "SELECT ZZ3_IDEQU,date_format(ZZ3_DATDIG,'%d/%m/%Y') ZZ3_DATDIG";
				$sql .= ",ZZ3_PLACA,ZZ3_FROTA,ZZ3_EMPEQU,ZZ3_TIPEQU";
				$sql .= ",ZZ3_POSSE,ZZ3_OBS,ZZ7_NOMEQU";
				$sql .= " FROM ZZ3";
				$sql .= " LEFT JOIN ZZ7 ON ZZ3_TIPEQU = ZZ7_TIPEQU";
				$sql .= " WHERE ZZ3_PLACA LIKE '%$placa%'";
				$sql .= " ORDER BY ZZ3_PLACA";
				sleep(1);
				$result = mysqli_query($cx,$sql);
				$cont   = mysqli_affected_rows($cx);
				// Verifica se a consulta retornou linhas 
				if ($cont > 0) {
					// Atribui o código HTML para montar uma tabel
					$return = '<table width="100%" border="2">';
					$return .= '<tr>';
					$return .= '<th align="center">Id</th>';
					$return .= '<th align="center">Placa</th>';
					$return .= '<th align="center">Frota</th>';
					$return .= '<th align="center">EmpresaEquip</th>';
					$return .= '<th align="center">Posse</th>';
					$return .= '<th align="center">Tipo</th>';
					$return .= '<th align="center">DescTipo</th>';
					$return .= '<th align="center">Observacoes</th>';
//					$return .= '<th align="center">Data Dig</th>';
					$return .= '<th align="center"></th>';
					$return .= '<th align="center"></th>';
					$return .= '</tr>';
					$return .= '<tbody>';
					// Captura os dados da consulta e insere na tabela HTML
					while($linha = mysqli_fetch_array($result)) { 
						$return .= '<tr>';
						$return .= '<td align="center"><font size="2">'.$linha["ZZ3_IDEQU"].'</font></td>';
						$return .= '<td align="center"><font size="2">'.$linha["ZZ3_PLACA"].'</font></td>';
						$return .= '<td align="center"><font size="2">'.$linha["ZZ3_FROTA"].'</font></td>';
						$return .= '<td align="center"><font size="2">'.$linha["ZZ3_EMPEQU"].'</font></td>';
						if ($linha["ZZ3_POSSE"]==1){
							$return .= '<td align="center"><font size="2">'.'Cliente'.'</font></td>';
						}elseif ($linha["ZZ3_POSSE"]==2){
							$return .= '<td align="center"><font size="2">'.'Fornecedor'.'</font></td>';			
						}elseif ($linha["ZZ3_POSSE"]==3){
							$return .= '<td align="center"><font size="2">'.'Particular'.'</font></td>';			
						}elseif ($linha["ZZ3_POSSE"]==4){
							$return .= '<td align="center"><font size="2">'.'LINAVE'.'</font></td>';			
						}
						$return .= '<td align="center"><font size="1">'.$linha["ZZ3_TIPEQU"].'</font></td>';
						$return .= '<td align="center"><font size="2">'.$linha["ZZ7_NOMEQU"].'</font></td>';
						$return .= '<td align="center"><font size="2">'.$linha["ZZ3_OBS"].'</font></td>';
//						$return .= '<td align="center"><font size="2">'.$linha["ZZ3_DATDIG"].'</font></td>';
//						$return .= '<td align=center><a href=visualizaequ.php?idequ='.$linha['ZZ3_IDEQU'].'><img src=img/visualizar.png></a></td>';
						$return .= '<td align=center><a href=editaequ.php?idequ='.$linha['ZZ3_IDEQU'].'><img src=img/editar.png></a></td>';
						$return .= '<td align=center><a href=deleta.php?id='.$linha['ZZ3_IDEQU'].'&tabdb=ZZ3&campo=IDEQU'.'><img src=img/excluir.png></a></td>';
						$return .= '</tr>';
					}
					$return .= '</tbody></table>';
					echo nl2br("************************************************************************************** \n");
					echo nl2br("*INCLUSAO NÃO PERMITIDA. ESTE EQUIPAMENTO JÁ ESTÁ CADASTRADO.     * \n");
					echo nl2br("************************************************************************************** \n");
					echo $return;
				} else {
					// Se a consulta não retornar nenhum valor, exibi mensagem para o usuário
					echo "Movimento Não encontrado! ";
					echo "Erro na inclusao. ";
				}
// até aqui pode ser eliminado e puxado do equipamento.php				
			}
		}
	}
}
?>	
