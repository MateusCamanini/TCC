<?php
$host = "localhost";
$usuario = "root";  
$senha = "";         
$banco_de_dados = "NutricionistaTCC";

$conexao = new mysqli($host, $usuario, $senha, $banco_de_dados);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}
?>