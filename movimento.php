<?php 
// Verifica se usuario logado
include("verifica.php");
// Verifica se existe as variáveis
if (isset($_GET["DataMov"])) {
    $DataMov = $_GET["DataMov"];
    // Conexao com o banco de dados
	include("conexao.php");
    // Verifica se a variável está vazia
    if (empty($DataMov)) {
        echo "";
    } else {
		// Retira os separadores da data
		$DataMov_1 = preg_replace("/[^0-9]/", "", $DataMov);
		include("listamov.php");
	}
}
?>	
