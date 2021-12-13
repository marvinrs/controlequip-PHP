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
    // Gera a select a partir da view vw_rastreamento
	$sql  = "SELECT * FROM VW_RASTREAMENTO ";
	if ($sql.$sql2.$sql3.$sql4 <>'') {
		$sql .= " WHERE ''='' " . $sql1 . $sql2 . $sql3 . $sql4;
	}
//	echo $sql;
//	sleep(1);
	$result = mysqli_query($cx,$sql);
	$cont   = mysqli_affected_rows($cx);
	// Verifica se a consulta retornou linhas 
	if ($cont > 0) {
		// Atribui o código HTML para montar uma tabel
		$return = '<table width="100%" border="2">';
		$return .= '<tr>';
		$return .= '<th style="font-size:8px" align="center">ID</th>';
//		$return .= '<th style="font-size:8px" align="center">PESSOA</th>';
		$return .= '<th style="font-size:8px" align="center">PLACA</th>';
		$return .= '<th style="font-size:8px" align="center">FROTA</th>';
		$return .= '<th style="font-size:8px" align="center">TIPO</th>';
		$return .= '<th style="font-size:8px" align="center">FILIAL</th>';
		$return .= '<th style="font-size:8px" align="center">PORTAL</th>';
		$return .= '<th style="font-size:8px" align="center">DATA</th>';
		$return .= '<th style="font-size:8px" align="center">HORA</th>';
		$return .= '<th style="font-size:8px" align="center">STATUS</th>';
		$return .= '<th style="font-size:8px" align="center">DIAS</th>';
		$return .= '</tr>';
		$return .= '<tbody>';
		// Captura os dados da consulta e insere na tabela HTML
		while($linha = mysqli_fetch_array($result)) { 
			$return .= '<tr>';
			$return .= '<td style="font-size:8px" align="center">'.$linha["ZZ4_IDEQU"].'</font></td>';
//			$return .= '<td style="font-size:8px" align="center">'.$linha["ZZ2_NOMPES"].'</font></td>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ3_PLACA"].'</font></td>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ3_FROTA"].'</font></td>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ3_TIPEQU"].'</font></td>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ4_NOMFIL"].'</font></td>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ4_NOMPOR"].'</font></td>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ4_DATMOV"].'</font></td>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ4_HORMOV"].'</font></td>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["ZZ4_STATUS"].'</font></td>';
			$return .= '<td style="font-size:12px" align="center">'.$linha["DIAS"].'</font></td>';
			$return .= '<td align=center><font size="1"><a href=visualizamov.php?idmov='.$linha['ZZ4_IDMOV'].'><img src=img/visualizar.png></a></td>';
			$return .= '</tr>';
		}
		echo $return .= '</tbody></table>';
	} else {
		// Se a consulta não retornar nenhum valor, exibi mensagem para o usuário
		echo "Movimento Não encontrado! ";
	}
?>	







