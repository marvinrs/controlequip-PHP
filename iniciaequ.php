<?php
    //*****
	//Rotina que carrega no listbox da pagina, os tipos de equipamentos
	//*****
	// Conexao com o banco de dados
	include("conexao.php");
	// verifica o codigo d o equipamento para marca-la na select de equipamentos
	if (isset($_GET["equAnt"])) {
		$equAnt = $_GET["equAnt"];
	}

	$sql = "SELECT * FROM ZZ7 ORDER BY ZZ7_NOMEQU";
    
	$result = mysqli_query($cx,$sql);
	$cont = mysqli_affected_rows($cx);
	// Verifica se a consulta retornou linhas 
	if ($cont > 0) {
		// Atribui o código HTML para montar uma tabela
		$return = '<select name="txtTipEqu" id="txtTipEqu">';
		$return.= '<option value="0"';
		$return.= "></option>";
		// Captura os dados da consulta e insere na select HTML
		while ($linha = mysqli_fetch_array($result)) {
			$return.= '<option value="' . utf8_encode($linha["ZZ7_TIPEQU"]) . '"';
			if ($equAnt == trim($linha["ZZ7_TIPEQU"])) {
				$return.='selected';
			}
			$return.= ">" . utf8_encode($linha["ZZ7_NOMEQU"]) . "</option>";
		}
		echo $return.= "</select>";;
	} else {
		// Se a consulta não retornar nenhum valor, exibe mensagem para o usuário
		echo "Não encontrada!";
	}
?>