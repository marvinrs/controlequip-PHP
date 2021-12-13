<?php 
    //*****
	//Rotina que carrega na listbox a lista de embarcacoes
	//*****
	// Conexao com o banco de dados

	// verifica se usuario logado
	include("verifica.php");
	
	if ($_SESSION["portal_usuario"] == '2') {

		// verifica o codigo da embacacao para marca-la na select de embarcacoes
		if (isset($_GET["embarc"])) {
			$embarc = $_GET["embarc"];
		}
		// conecta com o banco de dados Mysql
		include("conexao.php");

		// Gera combo com as tabelas de embarcacao
		$sql = " SELECT ZZ8_IDEMB,";
		$sql.= " 		ZZ8_CODEMB,";
		$sql.= " 		ZZ8_DESCR";
		$sql.= " FROM ZZ8";
		$sql.= " ORDER BY ZZ8_CODEMB";
		$result = mysqli_query($cx,$sql);
		$cont   = mysqli_affected_rows($cx);
		// Verifica se a consulta retornou linhas
		if ($cont > 0) {
			// Atribui o código HTML para montar uma tabela
			$return = '<td style="font-size:12px" width="5%" align="top">';
			if ($embarc == '0') {
				$return.='embarcacao:';
			}
			$return.= '<select name="embarcacao" id="embarcacao" class="pula">';
			$return.= '<option value="0"></option>';

			// Captura os dados da consulta e insere na tabela HTML
			while ($linha = mysqli_fetch_array($result)) {
				$return.= '<option value="' . utf8_encode($linha["ZZ8_CODEMB"]) . '"';
				if ($embarc == trim($linha["ZZ8_CODEMB"])) {
					$return.='selected';
				}
				$return.= ">" . utf8_encode($linha["ZZ8_CODEMB"]) . "</opttion>";
			}
			echo $return.= "</select></td>";;
		} else {
			// Se a consulta não retornar nenhum valor, exibe mensagem para o usuário
			echo "Não encontrada!";
		}
	}
?>	
