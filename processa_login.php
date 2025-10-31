<?php
session_start();
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (empty($email) || empty($senha)) {
        echo "<script>alert('Por favor, preencha todos os campos.'); window.location.href='login.html';</script>";
        exit;
    }

    // Busca o usuário pelo e-mail
    $sql = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conexao->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        // Verifica se a senha digitada bate com o hash do banco
        if (password_verify($senha, $usuario['senha'])) {
            // Login correto
            $_SESSION['idUsuario'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: home.php");
            exit;
        } else {
            echo "<script>alert('Senha incorreta!'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('E-mail não encontrado!'); window.location.href='login.html';</script>";
    }

    $stmt->close();
    $conexao->close();
}
?>