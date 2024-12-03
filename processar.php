<?php
session_start(); // Inicia a sessão

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processa os dados do formulário
    $file = 'respostas.txt'; // Nome do arquivo onde as respostas serão salvas
    $data = implode("\n", $_POST) . "\n"; // Converte as respostas em uma string

    // Salva as respostas no arquivo
    if (file_put_contents($file, $data, FILE_APPEND) === false) {
        $_SESSION['message'] = "Erro ao salvar suas respostas.";
    } else {
        $_SESSION['message'] = "Você já preencheu o formulário!";
    }

    // Redireciona para a página do aluno
    header("Location: pagina-aluno.php");
    exit(); // Para garantir que o script pare após o redirecionamento
}
?>