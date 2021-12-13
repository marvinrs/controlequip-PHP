<?php
// Verifica se existe a variável txtnome
if (isset($_GET["txtnome"])) {
    $nome = $_GET["txtnome"];
    // Conexao com o banco de dados
    // Verifica se a variável está vazia
	include("conexao.php");
    if (empty($nome)) {
        echo ""; 
    } else {
        $sql = "SELECT * FROM zz2 LEFT JOIN ZZ3 ON ZZ3_IDEQU=ZZ2_IDEQU WHERE ZZ2_NOMPES like '$nome%' ORDER BY ZZ2_NOMPES";
    
//		sleep(1);
		$result = mysqli_query($cx,$sql);
		$cont = mysqli_affected_rows($cx);
		// Verifica se a consulta retornou linhas 
		if ($cont > 0) {
			// Atribui o código HTML para montar uma tabela
			$return = '<select name="ResultadoPessoa" class="pula" id="ResultadoPessoa" langsize="5"  style="background: #009966; color: #FFF;">';

			// Captura os dados da consulta e insere na tabela HTML
			while ($linha = mysqli_fetch_array($result)) {
				$return.= '<option value="' . utf8_encode($linha["ZZ2_IDPES"]) . '"';
				$return.= ">" . utf8_encode($linha["ZZ2_NOMPES"]) . "-" . utf8_encode($linha["ZZ2_EMPPES"]) . "</option>";
				$a = utf8_encode($linha["ZZ3_PLACA"]);
			}
			echo $return.= '</select>';
			
		} else {
			// Se a consulta não retornar nenhum valor, exibe mensagem para o usuário
			echo "Não encontrada!";
		}
	}
}
?>