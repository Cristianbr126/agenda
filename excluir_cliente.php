<?php
require_once "config.php";

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: clientes.php");
    exit();
}

$id = (int)$_GET["id"];

$stmt = $pdo->prepare("SELECT nome, email FROM clientes WHERE id = ?");
$stmt->execute([$id]);
$cliente = $stmt->fetch();

if (!$cliente) {
    header("Location: clientes.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["confirmar"]) && $_POST["confirmar"] === "sim") {
        $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
    }
    header("Location: clientes.php");
    exit();
}

include "cabecalho.php";
?>

<h2>Excluir Cliente</h2>
<p>Tem certeza que deseja excluir <strong><?= htmlspecialchars($cliente['nome']) ?></strong> (<?= htmlspecialchars($cliente['email']) ?>)?</p>

<form method="post">
    <button type="submit" name="confirmar" value="sim" class="btn-excluir">Sim, excluir</button>
    <a href="clientes.php" class="btn-cancelar">Cancelar</a>
</form>

</body>
</html>