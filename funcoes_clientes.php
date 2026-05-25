<?php

function obterClientes(PDO $pdo): array {
    $stmt = $pdo->query('SELECT id, nome, CPF, email, telefone, endereco FROM clientes ORDER BY nome');
    return $stmt->fetchAll();
}

function exibirTabelaClientes(array $clientes): void {
    if (empty($clientes)) {
        echo "<p>Nenhum cliente encontrado.</p>";
        return;
    }

    echo "<table border='1' cellpadding='8'>";
    echo "<thead><tr><th>#</th><th>Nome</th><th>CPF</th><th>E-mail</th><th>Telefone</th><th>Endereço</th><th>ações</th></tr></thead>";
    echo "<tbody>";

    foreach ($clientes as $indice => $cliente) {
        $num = $indice + 1;
        $nome = htmlspecialchars($cliente['nome']);
        $CPF = $cliente['CPF']; // só números
        // Formata o CPF: 000.000.000-00
        $cpfFormatado = '';
        if (strlen($CPF) == 11) {
            $cpfFormatado = substr($CPF, 0, 3) . '.' . substr($CPF, 3, 3) . '.' . substr($CPF, 6, 3) . '-' . substr($CPF, 9, 2);
        } else {
            $cpfFormatado = $CPF; // se não tiver 11 dígitos, mostra como está
        }
        $email = htmlspecialchars($cliente['email']);
        $telefone = htmlspecialchars($cliente['telefone']);
        $endereco = htmlspecialchars($cliente['endereco']);

        echo "<tr>";
        echo "<td>{$num}</td>";
        echo "<td>{$nome}</td>";
        echo "<td>{$cpfFormatado}</td>";
        echo "<td>{$email}</td>";
        echo "<td>{$telefone}</td>";
        echo "<td>{$endereco}</td>";
        echo "<td><a href=\"editar_cliente.php?id={$cliente['id']}\" class='btn-editar'>Editar</a> | <a href=\"excluir_cliente.php?id={$cliente['id']}\" class='btn-excluir' onclick=\"return confirm('Tem certeza que deseja excluir este cliente?');\">Excluir</a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

