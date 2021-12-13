<?php
// Verifica se existe a variável txtEquipamento
if (isset($_GET["txtEquipamento"])) {
    $Equipamento= $_GET["txtEquipamento"];
	// verifica se foi informada a pesquisa por placa ou frota
	if (isset($_GET["placafrota"]))
		$placafrota	= $_GET["placafrota"];
	else{
		$placafrota	= "PLACA";
	}
	$Seq = $_GET["seq"];
	$pessoa = $_GET["pessoa"];
	echo $placafrota;
    // Conexao com o banco de dados
	include("conexao.php");
    // Verifica se a variável está vazia
    if (empty($Equipamento) && empty($pessoa)) {
		echo "";
    } else {
		if (empty($Equipamento)) {
			$sql = "SELECT * FROM ZZ3 INNER JOIN ZZ2 ON ZZ2_IDEQU=ZZ3_IDEQU WHERE ZZ2_IDPES =" . $pessoa;
		}else{
			$sql = "SELECT * FROM zz3 WHERE ZZ3_".$placafrota." like '%$Equipamento%' ORDER BY ZZ3_".$placafrota;
		}	
		echo $sql;
//		sleep(1);
		$result = mysqli_query($cx,$sql);
		$cont = mysqli_affected_rows($cx);
		// Verifica se a consulta retornou linhas 
		if ($cont > 0) {
			// Atribui o código HTML para montar um combobox
			if ($Seq == "1") {
				$return = '<select name="ResultadoEquipamento" id="ResultadoEquipamento">';
			}
			else if ($Seq == "2") {
				$return = '<select name="ResultadoEquipamento2" id="ResultadoEquipamento2">';
			}
			else if ($Seq == "3") {
				$return = '<select name="ResultadoEquipamento3" id="ResultadoEquipamento3">';
			}
			else if ($Seq == "4") {
				$return = '<select name="ResultadoEquipamento4" id="ResultadoEquipamento4">';
			}
			// Captura os dados da consulta e insere na tabela HTML
			while ($linha = mysqli_fetch_array($result)) {
				$return.= '<option value="' . utf8_encode($linha["ZZ3_IDEQU"]) . '"';
				$return.= '>' . utf8_encode($linha["ZZ3_PLACA"]);
				if ($linha["ZZ3_FROTA"]!='') {
					$return.= '-' . utf8_encode($linha["ZZ3_FROTA"]);
				}
				if ($linha["ZZ3_EMPEQU"]!=''){
					$return.= '-' . trim(utf8_encode($linha["ZZ3_EMPEQU"]));
				}
				$return.= "</option>";
			}
			echo $return.= "</select>";;
		} else {
			// Se a consulta não retornar nenhum valor, exibi mensagem para o usuário
			echo "Não encontrada!";
		}
    }

}
?>