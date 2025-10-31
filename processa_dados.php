<?php

require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //echo '<pre>';
    //print_r($_POST);
    //echo '</pre>';
    //exit;
  
    $nome = $_POST['txtNome'] ?? '';
    $data_nascimento = $_POST['txtDataNascimento'] ?? '';
    $email = $_POST['txtEmail'] ?? '';
    $senha = $_POST['txtSenha'] ?? '';
    $cpf = $_POST['txtCPF'] ?? '';
    $telefone = $_POST['txtTelefone'] ?? '';
    $peso = $_POST['txt_peso'] ?? '';
    $altura = $_POST['txtaltura'] ?? '';
    $genero = $_POST['txtgenero'] ?? '';
    $nivelAtividade = $_POST['txt_nivelAtividade'] ?? '';
    $objetivoFinal = $_POST['txt_objetivo'] ?? '';
    $restricoes = $_POST['txt_Restricoes'] ?? '';
    $preferencias = $_POST['txt_Preferencias'] ?? '';
    $historicoSaude = $_POST['txt_HistoricoDeSaude'] ?? '';

    $senha = password_hash($_POST['txtSenha'] ?? '', PASSWORD_DEFAULT);

    // Verifica se o e-mail já existe
    $verifica = $conexao->prepare("SELECT codigo FROM usuario WHERE email = ?");
    $verifica->bind_param("s", $email);
    $verifica->execute();
    $resultado = $verifica->get_result();

if ($resultado->num_rows > 0) {
    echo "<script>alert('Este e-mail já está cadastrado!'); window.history.back();</script>";
    exit;
}

    $sql = "INSERT INTO usuario (nome, email, senha, telefone, cpf, dataDeNascimento, peso, altura, genero, nivelAtividade, objetivoFinal, restricoes, preferencias, historicoSaude) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = $conexao->prepare($sql);

 if ($stmt === false) {
     // exibe erro de preparação em modo de desenvolvimento
     echo "Erro na preparação da query: " . $conexao->error;
     exit;
 }

 // bind_param espera: tipos como string (ex: "sssss") e as variáveis por referência
 $stmt->bind_param("ssssssssssssss", $nome, $email, $senha, $telefone, $cpf, $data_nascimento , $peso, $altura, $genero, $nivelAtividade, $objetivoFinal, $restricoes, $preferencias, $historicoSaude);

 // Executa a query
 if ($stmt->execute()) {
        // Redireciona para a tela de sucesso
        header("Location: sucessoDeCadastro.html");
        exit;
    } else {
        echo "Erro ao inserir dados: " . $stmt->error;
    }

    // Fecha o statement e a conexão
    $stmt->close();
    $conexao->close();
}
?>