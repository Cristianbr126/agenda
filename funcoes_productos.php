<?php 
function obterProdutos(PDO $pdo): array {
    $stmt = $pdo->query("SELECT * FROM produtos ORDER BY nome");
    return $stmt->fetchAll();
}

function exibirTabelaProdutos(array $produtos): void {
    if (empty($produtos)) {
        echo "<p>Nenhum produto encontrado.</p>";
        return;
    }

    echo "<table border='1' cellpadding='8'>";
    echo "<thead><tr><th>#</th><th>Nome</th><th>Descrição</th><th>Preço</th><th>Estoque</th><th>Imagem</th><th>Ações</th></tr></thead>";
    echo "<tbody>";
    foreach ($produtos as $i => $p) {
        $num = $i+1;
        $imagem = !empty($p['imagem']) ? "uploads/" . $p['imagem'] : "";
        $imgHtml = $imagem ? "<img src='$imagem' width='50'>" : "Sem imagem";
        echo "<tr>";
        echo "<td>$num</td>";
        echo "<td>" . htmlspecialchars($p['nome']) . "</td>";
        echo "<td>" . htmlspecialchars($p['descricao']) . "</td>";
        echo "<td>R$ " . number_format($p['preco'], 2, ',', '.') . "</td>";
        echo "<td>" . $p['estoque'] . "</td>";
        echo "<td>$imgHtml</td>";
        echo "<td><a href='editar_produto.php?id={$p['id']}' class='btn-editar'>Editar</a> | <a href='excluir_produto.php?id={$p['id']}' class='btn-excluir'>Excluir</a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}
?>