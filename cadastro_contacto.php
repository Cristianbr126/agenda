<?php
// cadastro_contato.php
require_once "config.php";
include "cabecalho.php";

$erro = ''; // variável para mensagem de erro

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');

    // Validação: nome e e-mail são obrigatórios
    if ($nome === '' || $email === '') {
        $erro = 'Nome e e-mail são obrigatórios.';
    } else {
        // Prepared statement para inserir
        $stmt = $pdo->prepare(
            'INSERT INTO contactos (nome, email, telefone) VALUES (?, ?, ?)'
        );
        $stmt->execute([$nome, $email, $telefone]);
        header('Location: index.php');
        exit;
    }
}
?>

<h2>Cadastrar Novo Contato</h2>

<?php if ($erro): ?>
    <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<form method="post" action="">
    <label for="nome">Nome:</label><br>
    <input type="text" name="nome" id="nome" required><br><br>

    <label for="email">E-mail:</label><br>
    <input type="email" name="email" id="email" required><br><br>

    <label for="telefone">Telefone:</label><br>
    <input type="text" name="telefone" id="telefone"><br><br>

    <button type="submit">Salvar</button>
</form>

</body>
</html>