<?php
// funcoes.php — funções reutilizáveis

/**
 * Retorna o array de contatos.
 * Em um projeto real, isso viria do banco de dados.
 */
function obterContatos(PDO $pdo): array {

        $stmt = $pdo->query('SELECT id, nome, email, telefone FROM contactos ORDER BY nome');
        return $stmt->fetchAll();
    }


/**
 * Renderiza a tabela HTML com a lista de contatos.
 */
function exibirTabelaContatos(array $contatos): void {
    if (empty($contatos)) {
        echo "<p>Nenhum contato encontrado.</p>";
        return;
    }
    echo "";
    echo "<table>\n";
    echo "  <thead>\n";
    echo " <th>#</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Ações</th></tr>\n ";
    echo "  </thead>\n";
    echo "  <tbody>\n";

    foreach ($contatos as $indice => $contato) {
        $num   = $indice + 1;
        $id = $contato['id'];
        $nome  = htmlspecialchars($contato['nome']);
        $email = htmlspecialchars($contato['email']);
        $fone  = htmlspecialchars($contato['telefone']);

        echo "    <tr>\n";
        echo "      <td>{$num}</td>\n";
        echo "      <td>{$nome}</td>\n";
        echo "      <td>{$email}</td>\n";
        echo "      <td>{$fone}</td>\n";
        echo "      <td><a href=\"editar_contacto.php?id={$id}\" class='btn-editar'>Editar</a> | <a href=\"excluir_contacto.php?id={$id}\" class='btn-excluir'>Excluir</a></td>\n";
        echo "    </tr>\n";
    }

    echo "  </tbody>\n";
    echo "</table>\n";
}


function listarContatosPaginados(PDO $pdo, string $busca = '', int $pagina = 1, int $porPagina = 5): array {
    $offset = ($pagina - 1) * $porPagina;
    $termo  = '%' . $busca . '%';
    $stmt   = $pdo->prepare(
        'SELECT * FROM contactos   
         WHERE nome LIKE ? OR email LIKE ?
         ORDER BY nome
         LIMIT ? OFFSET ?'
    );
    $stmt->execute([$termo, $termo, $porPagina, $offset]);
    return $stmt->fetchAll();
}

function totalContatos(PDO $pdo, string $busca = ''): int {
    $termo = '%' . $busca . '%';
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM contactos WHERE nome LIKE ? OR email LIKE ?');
    $stmt->execute([$termo, $termo]);
    return (int)$stmt->fetchColumn();
}