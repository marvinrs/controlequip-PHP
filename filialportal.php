<?php
	include("verifica.php");
	// Retorna a filial e portal do usuario logado 
	$return  = ' Filial:<input type="text" id=txtfilial size="4" readonly="true" value='.$filial.'>';
	echo $return .= ' Portal:<input type="text" id=txtportal size="1" readonly="true" value='.$portal.'>';
	
?>