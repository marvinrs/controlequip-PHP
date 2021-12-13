<?php 
// Inicia sessões 
session_start(); 
 
// Usuario e Senha informada no login 
$login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE; 
// Recupera a senha, a criptografando em Whirlpool
$senha = isset($_POST["senha"]) ? hash('whirlpool',trim($_POST["senha"])) : FALSE; 
//echo $login;
//echo $senha;
// Usuário não forneceu a senha ou o login 
if(!$login || !$senha) 
{ 
	echo "Você deve digitar sua senha e login!"; 
	exit; 
} 
 
/** 
* Executa a consulta no banco de dados. 
* Caso o número de linhas retornadas seja 1 o login é válido, 
* caso 0, inválido. 
*/
include("conexao.php");
$SQL 	   	= "SELECT * FROM ZZ0 WHERE ZZ0_LOGIN='$login'";
$result_id 	= @mysqli_query($cx,$SQL);
$cont   	= mysqli_affected_rows($cx);
// Caso o usuário tenha digitado um login válido o número de linhas será 1.. 
if($cont > 0) 
{
	// Obtém os dados do usuário, para poder verificar a senha e passar os demais dados para a sessão 
	$dados = @mysqli_fetch_array($result_id); 
	
	// Agora verifica a senha 
	if(!strcmp($senha, $dados["ZZ0_SENHA"])) 
	{
	// TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário 
		$_SESSION["id_usuario"] = $dados["ZZ0_ID"];
		$_SESSION["nome_usuario"] = stripslashes($dados["ZZ0_LOGIN"]); 
		$_SESSION["filial_usuario"]= $dados["ZZ0_FILIAL"]; 
		$_SESSION["portal_usuario"]= $dados["ZZ0_PORTAL"]; 
		header("Location: movimento.html"); 
		exit; 
	}
	else
	// Senha inválida 
	{
		echo "Senha invalida!"; 
		exit; 
	}
}
// Login inválido 
else
{
	echo "Login inexistente!"; 
	exit; 
}
?>