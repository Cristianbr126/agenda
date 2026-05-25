<?php
require_once "config.php";

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$id = (int)$_GET["id"];

// Busca os dados do contato para exibir na confirmação
$stmt = $pdo->prepare("SELECT nome, email FROM contactos WHERE id = ?");
$stmt->execute([$id]);
$contato = $stmt->fetch();

if (!$contato) {
    header("Location: index.php");
    exit();
}

// Se o formulário de confirmação foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["confirmar"]) && $_POST["confirmar"] === "sim") {
        $stmt = $pdo->prepare("DELETE FROM contactos WHERE id = ?");
        $stmt->execute([$id]);
    }
    header("Location: index.php");
    exit();
}

// Só depois de todo processamento, inclui o HTML
include "cabecalho.php";
?>

<h2>Excluir Contato</h2>
<p>Tem certeza que deseja excluir <strong><?= htmlspecialchars($contato['nome']) ?></strong> (<?= htmlspecialchars($contato['email']) ?>)?</p>

<form method="post">
    <button type="submit" name="confirmar" value="sim" class="btn-excluir">Sim, excluir</button>
    <a href="index.php" class="btn-cancelar">Cancelar</a>
</form>

</body>
</html>