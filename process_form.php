<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos do formulário estão presentes
    if (isset($_POST["nome"]) && isset($_POST["cpf"]) && isset($_POST["email"]) && isset($_POST["telefone"]) && isset($_POST["data"]) && isset($_POST["horario"])) {
        // Recupera os valores do formulário
        $nome = $_POST["nome"];
        $cpf = $_POST["cpf"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $data = $_POST["data"];
        $horario = $_POST["horario"];

        // Caminho para o arquivo do banco de dados SQLite
        $dbFile = 'dados.db';

        // Verifica se o arquivo do banco de dados existe
        if (!file_exists($dbFile)) {
            // Se o arquivo do banco de dados não existir, exibe uma mensagem de erro
            echo "Erro: Arquivo do banco de dados não encontrado.";
            exit; // Termina a execução do script
        }

        // Conexão com o banco de dados
        $db = new SQLite3($dbFile);

        // Prepara a consulta SQL para inserir os dados do formulário na tabela 'formulario'
        $query = "INSERT INTO formulario (nome, cpf, email, telefone, data, horario) VALUES (:nome, :cpf, :email, :telefone, :data, :horario)";
        $stmt = $db->prepare($query);

        // Verifica se a preparação da declaração foi bem sucedida
        if (!$stmt) {
            echo "Erro na preparação da declaração SQL: " . $db->lastErrorMsg();
            exit; // Termina a execução do script
        }

        // Bind dos parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':horario', $horario);

        // Executa a declaração preparada
        $result = $stmt->execute();

        // Verifica se a execução da declaração foi bem sucedida
        if (!$result) {
            echo "Erro ao executar a declaração SQL: " . $db->lastErrorMsg();
            exit; // Termina a execução do script
        }

        // Redireciona para a página listarConsultas.php após o envio do formulário
        header("Location: listarConsultas.php");
        exit; // Termina a execução do script após o redirecionamento
    } else {
        // Se algum campo do formulário estiver faltando, exibe uma mensagem de erro
        echo "Erro: Todos os campos do formulário devem ser preenchidos.";
    }
} else {
    // Se o método de requisição não for POST, exibe uma mensagem de erro
    echo "Erro: O formulário deve ser submetido via método POST.";
}
?>
