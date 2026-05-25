<?php
require_once "config.php";
include "cabecalho.php";

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome'] ?? '');
    $cpf      = preg_replace('/[^0-9]/', '', $_POST['cpf'] ?? ''); // só números
    $email    = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');

    if ($nome === '' || $email === '') {
        $erro = 'Nome e e-mail são obrigatórios.';
    } else {
        $stmt = $pdo->prepare(
            'INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES (?, ?, ?, ?, ?)'
        );
        $stmt->execute([$nome, $cpf, $email, $telefone, $endereco]);
        header('Location: clientes.php');
        exit;
    }
}
?>

<h2>Cadastrar Novo Cliente</h2>
<?php if ($erro): ?>
    <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<form method="post">
    <label>Nome:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>CPF (apenas números):</label><br>
    <input type="text" name="cpf"  pattern="[0-9]{11}" placeholder="12345678900"><br><br>

    <label>E-mail:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Telefone:</label><br>
    <input type="text" name="telefone"><br><br>

    <label>Endereço:</label><br>
    <input type="text" name="endereco"><br><br>

    <button type="submit">Salvar</button>
</form>

</body>
</html>