<?php
// send_to_chatgpt.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simulação de dados que você deseja enviar
    $respostas = [
        ['nome' => 'Teste', 'status' => 'Pronto para Análise'],
        // Adicione mais respostas conforme necessário
    ];

    // Aqui você pode formatar as respostas como desejar
    $mensagem = "Respostas dos Alunos:\n";
    foreach ($respostas as $resposta) {
        $mensagem .= "Nome: " . htmlspecialchars($resposta['nome']) . ", Status: " . htmlspecialchars($resposta['status']) . "\n";
    }

    // Aqui você deve implementar a lógica para enviar a mensagem para o ChatGPT
    // Exemplo usando cURL para enviar uma requisição para a API do ChatGPT
    $apiKey = 'SUA_CHAVE_API_AQUI'; // Substitua pela sua chave API
    $url = 'https://api.openai.com/v1/chat/completions';

    $data = [
        'model' => 'gpt-3.5-turbo', // Ou outro modelo que você esteja usando
        'messages' => [
            ['role' => 'user', 'content' => $mensagem],
        ],
    ];

    $options = [
        'http' => [
            'header'  => [
                "Content-Type: application/json",
                "Authorization: Bearer $apiKey"
            ],
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        // Em caso de erro, você pode redirecionar de volta com uma mensagem de erro
        header('Location: index.php?error=Erro ao enviar para o ChatGPT');
        exit;
    }

    // Se o envio for bem-sucedido, você pode redirecionar de volta com uma mensagem de sucesso
    header('Location: index.php?success=Respostas enviadas com sucesso para o ChatGPT');
    exit;
} else {
    // Se não for uma requisição POST, redireciona de volta
    header('Location: index.php');
    exit;
}
?>