<?php

$usuario = 'ptrportaria';
$senha   = '1344';
$codificada = hash('whirlpool', $senha);
include("conexao.php");
echo "usuario:" . $usuario;
echo " Senha codificada: " . $codificada;

?>