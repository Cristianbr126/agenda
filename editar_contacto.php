<?php
require_once "config.php";
include "cabecalho.php";

// Verifica se o ID foi passado pela URL
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$id = (int)$_GET["id"]; // Converte para inteiro por segurança

// Busca o contato no banco de dados
$stmt = $pdo->prepare("SELECT * FROM contactos WHERE id = ?");
$stmt->execute([$id]);
$contato = $stmt->fetch();

// Se o contato não existir, volta para a lista
if (!$contato) {
    header("Location: index.php");
    exit();
}

$erro = '';

// Processa o formulário quando enviado via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome     = trim($_POST["nome"] ?? '');
    $email    = trim($_POST["email"] ?? '');
    $telefone = trim($_POST["telefone"] ?? '');

    if ($nome === '' || $email === '') {
        $erro = "Nome e e-mail são obrigatórios.";
    } else {
        $stmt = $pdo->prepare("UPDATE contactos SET nome = ?, email = ?, telefone = ? WHERE id = ?");
        $stmt->execute([$nome, $email, $telefone, $id]);
        header("Location: index.php");
        exit();
    }
}
?>

<h2>Editar Contato</h2>

<?php if ($erro): ?>
    <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<form method="post" action="">
    <label for="nome">Nome:</label><br>
    <input type="text" name="nome" id="nome" required
           value="<?= htmlspecialchars($contato['nome']) ?>"><br><br>

    <label for="email">E-mail:</label><br>
    <input type="email" name="email" id="email" required
           value="<?= htmlspecialchars($contato['email']) ?>"><br><br>

    <label for="telefone">Telefone:</label><br>
    <input type="text" name="telefone" id="telefone"
           value="<?= htmlspecialchars($contato['telefone']) ?>"><br><br>

    <button type="submit">Atualizar</button>
    <a href="index.php">Cancelar</a>
</form>

</body>
</html>