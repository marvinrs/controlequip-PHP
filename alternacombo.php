<?php 
    //*****
	//Rotina que alterna na tela, os combobox: finalidade e deslocamento
	//*****
	include("verifica.php");
	if (isset($_SESSION["portal_usuario"])) {
		$portal = $_SESSION["portal_usuario"];
		if ($portal == '1') {
			$return = '<td style="font-size:12px" width="5%">finalidade:<select name="finalidade" id="finalidade" class="pula">';
			$return.= '		<option value="0"></option>';
			$return.= '		<option value="1">A Servico </option>';
			$return.= '		<option value="2">Desembarque</option>';
			$return.= '		<option value="3">Embarque</option>';
			$return.= '		<option value="4">Entrega</option>';
			$return.= '		<option value="5">Retirada</option>';
			$return.= '		<option value="6">Visita</option>';
		}else{
			$return = '<td style="font-size:12px" width="5%">origem/destino:<select name="deslocamento" id="deslocamento" class="pula">';
			$return.= '		<option value="0"></option>';
			$return.= '		<option value="1">Belem</option>';
			$return.= '		<option value="2">Manaus</option>';
			$return.= '		<option value="3">Santarem</option>';
			$return.= '		<option value="4">Trombetas</option>';
			$return.= '		<option value="5">Cliente</option>';
			$return.= '		<option value="6">Fornecedor</option>';
			$return.= '		<option value="7">Outros</option>';
		}
		echo $return.= "</select></td>";
	} else {
		// Se a consulta não retornar nenhum valor, exibe mensagem para o usuário
		echo "Não encontrada!";
	}
?>	
		