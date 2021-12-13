<?php 
// Verifica se existe a variável GET
$sql1 ='';
$sql2 ='';
$sql3 ='';
$sql4 ='';
if (isset($_GET["dataini"])) {
	// Filtra por periodo
    $dataini = preg_replace("/[^0-9]/", "", $_GET["dataini"]);
    $datafim = preg_replace("/[^0-9]/", "", $_GET["datafim"]);
	$sql1  = " AND ZZ4_DATMOV BETWEEN '$dataini' AND '$datafim'";
	}
if (isset($_GET["posse"])) {
    // filtra por proprietario (posse)
	$posse = $_GET["posse"];
	$sql2  = " AND ZZ3_POSSE = '$posse'";
}
if (isset($_GET["tipequ"])) {
    $tipequ = $_GET["tipequ"];
	$equipamento = $_GET["equipamento"];
	if ($tipequ == '2') {
		// filtra por placa
		$sql3 = " AND ZZ3_PLACA LIKE '%$equipamento%'";
	}else if ($tipequ == '3') {
		//filtra por frota
		$sql3 = " AND ZZ3_FROTA LIKE '%$equipamento%'";
	}
}

if (isset($_GET["tippes"])) {
    $tippes = $_GET["tippes"];
	$pessoa = $_GET["pessoa"];
	if ($tippes == '2') {
		// filtra por pessoa
		$sql4 = " AND ZZ2_NOMPES LIKE '%$pessoa%'";
	}else if ($tippes == '3') {
		// filtra por empresa do equipamento
		$sql4 = " AND ZZ3_EMPEQU LIKE '%$pessoa%'";
	}else if ($tippes == '4') {
		// filtra por filial
		$sql4 = " AND ZZ4_FILIAL LIKE '%$pessoa%'";
	}
}

    // Conexao com o banco de dados
	include("conexao.php");
    // Verifica se a variável está vazia
	// Retira os separadores da data
	$sql  = "SELECT Z4.ZZ4_IDMOV, ";
	$sql .= " (CASE	WHEN Z4.ZZ4_TIPMOV = 1 ";
	$sql .= "   		THEN 'CHEGADA' ";
	$sql .= "   		ELSE 'SAIDA' END) AS ZZ4_TIPMOV,";
	$sql .= " date_format(Z4.ZZ4_DATMOV,'%d/%m/%Y') AS DATMOV,";
	$sql .= " Z4.ZZ4_DATMOV AS DATDAY,";
	$sql .= " Z4.ZZ4_HORMOV, ";
	$sql .= " Z2.ZZ2_NOMPES,";
	$sql .= " Z3.ZZ3_PLACA,";
	$sql .= " Z3.ZZ3_FROTA,";
	$sql .= " Z3.ZZ3_EMPEQU,";
	$sql .= " Z3.ZZ3_TIPEQU,";
	$sql .= " (CASE  WHEN Z4.ZZ4_FILIAL = '0101' THEN 'BELEM' ";
	$sql .= "        WHEN Z4.ZZ4_FILIAL = '0102' THEN 'MANAUS'"; 
	$sql .= "        WHEN Z4.ZZ4_FILIAL = '0103' THEN 'SANTAREM'"; 
	$sql .= "        WHEN Z4.ZZ4_FILIAL = '0104' THEN 'TROMBETAS' ";
	$sql .= "        ELSE '' END) AS ZZ4_FILIAL,";
	$sql .= " (CASE  WHEN Z4.ZZ4_PORTAL = '1' THEN 'Portaria' ";
	$sql .= " 		 WHEN Z4.ZZ4_PORTAL = '2' THEN 'Porto'";
	$sql .= "        ELSE '' END) AS ZZ4_PORTAL";
	$sql .= " FROM ZZ4 Z4";
	$sql .= " LEFT JOIN ZZ2 Z2 ON Z2.ZZ2_IDPES = Z4.ZZ4_IDPES";
	$sql .= " LEFT JOIN ZZ3 Z3 ON Z3.ZZ3_IDEQU = Z4.ZZ4_IDEQU";
	$sql .= " WHERE Z4.D_E_L_E_T_ <> '*'";
	$sql .= $sql1 . $sql2 . $sql3 . $sql4;
	$sql .= " ORDER BY ZZ4_DATMOV,ZZ4_HORMOV";
	//	echo $sql;
	sleep(1);
	$result = mysqli_query($cx,$sql);
	$cont   = mysqli_affected_rows($cx);
	// Verifica se a consulta retornou linhas 
	if ($cont > 0) {
		// Atribui o código HTML para montar uma tabel
		$return = '<table width="100%" border="2">';
		$return .= '<tr>';
		$return .= '<th align="center"><font size="1">Id</th>';
		$return .= '<th align="center"><font size="1">Tipo Mov</th>';
		$return .= '<th align="center"><font size="1">Data</th>';
		$return .= '<th align="center"><font size="1">Hora</th>';
		$return .= '<th align="center"><font size="1">Pessoa</th>';
		$return .= '<th align="center"><font size="1">Placa</th>';
		$return .= '<th align="center"><font size="1">Frota</th>';
		$return .= '<th align="center"><font size="1">TipEqu</th>';
		$return .= '<th align="center"><font size="1">Filial</th>';
		$return .= '<th align="center"><font size="1">Portal</th>';
		$return .= '<th align="center"><font size="1">DIAS</th>';
		$return .= '</tr>';
		$return .= '<tbody>';
		// Guarda variavel DIAS entre datas do movimento
		$datant="";
		$dias = 0;
		// Captura os dados da consulta e insere na tabela HTML
		while($linha = mysqli_fetch_array($result)) { 
			$return .= '<tr>';
			$return .= '<td align="center"><font size="1">'.$linha["ZZ4_IDMOV"].'</font></td>';
			$return .= '<td align="center"><font size="1">'.$linha["ZZ4_TIPMOV"].'</font></td>';
			$return .= '<td align="center"><font size="1">'.$linha["DATMOV"].'</font></td>';
			$return .= '<td align="center"><font size="1">'.$linha["ZZ4_HORMOV"].'</font></td>';
			$return .= '<td align="center"><font size="1">'.$linha["ZZ2_NOMPES"].'</font></td>';
			$return .= '<td align="center"><font size="1">'.$linha["ZZ3_PLACA"].'</font></td>';
			$return .= '<td align="center"><font size="1">'.$linha["ZZ3_FROTA"].'</font></td>';
			$return .= '<td align="center"><font size="1">'.$linha["ZZ3_TIPEQU"].'</font></td>';
			$return .= '<td align="center"><font size="1">'.$linha["ZZ4_FILIAL"].'</font></td>';
			$return .= '<td align="center"><font size="1">'.$linha["ZZ4_PORTAL"].'</font></td>';
			if ($datant <> ""){
				$dias = floor((strtotime( $linha["DATDAY"]) - strtotime( $datant)) /(60*60*24));
			}	
			$return .= '<td align="center"><font size="1">'.$dias.'</font></td>';
			$datant = $linha["DATDAY"];
			$return .= '<td align=center><font size="1"><a href=visualizamov.php?idmov='.$linha['ZZ4_IDMOV'].'><img src=img/visualizar.png></a></td>';
			// Retirado para evitar alteracoes indevidas $return .= '<td align=center><font size="1"><a href=editamov.php?idmov='.$linha['ZZ4_IDMOV'].'><img src=img/editar.png></a></td>';
			// Retirado para evitar exclusoes indevidas $return .= '<td align=center><font size="1"><a href=deleta.php?id='.$linha['ZZ4_IDMOV'].'&tabdb=ZZ4&campo=IDMOV'.'><img src=img/excluir.png></a></td>';
			$return .= '</tr>';
		}
		echo $return .= '</tbody></table>';
	} else {
		// Se a consulta não retornar nenhum valor, exibi mensagem para o usuário
		echo "Movimento Não encontrado! ";
	}
?>