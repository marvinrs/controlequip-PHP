<?php 
	// Inicia sessões 
	session_start(); 
	 
	// Verifica se existe os dados da sessão de login 
	if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"])) 
	{ 
	// Usuário não logado! Redireciona para a página de login 
	header("Location: login.html"); 
	exit; 
	}
	$filial=$_SESSION["filial_usuario"];
	$portal=$_SESSION["portal_usuario"];
	$idusuario=$_SESSION["id_usuario"];
	$usuario=$_SESSION["nome_usuario"];
	if ($filial == '0101') {$nome_filial = 'Belem';}
	else if ($filial == '0102') {$nome_filial = 'Manaus';}
	else if ($filial == '0103') {$nome_filial = 'Santarem';}
	else if ($filial == '0104') {$nome_filial = 'Trombetas';}
	else	{$nome_filial = 'Outras';}
	if ($portal == '1') {$nome_portal = 'Portaria';}
	else if ($portal == '2') {$nome_portal = 'Porto';}
 ?>