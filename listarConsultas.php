<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Listagem de Consultas</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Listagem de Consultas</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Data</th>
                <th>Horário</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conexão com o banco de dados SQLite
            $db = new SQLite3('dados.db');

            // Verifica se a conexão foi bem sucedida
            if(!$db) {
                die("Erro ao conectar ao banco de dados.");
            }

            // Query para selecionar os dados
            $query = "SELECT * FROM formulario";

            // Executa a query
            $result = $db->query($query);

            // Loop através dos resultados e exibe os dados em uma tabela
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                echo "<tr>";
                echo "<td>".$row['nome']."</td>";
                echo "<td>".$row['cpf']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['telefone']."</td>";
                echo "<td>".$row['data']."</td>";
                echo "<td>".$row['horario']."</td>";
                echo "</tr>";
               
            }

            // Fecha a conexão com o banco de dados
            $db->close();
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
