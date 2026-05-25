<?php
require_once "config.php";

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: productos.php");
    exit();
}

$id = (int)$_GET["id"];

$stmt = $pdo->prepare("SELECT nome, imagem FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch();

if (!$produto) {
    header("Location: productos.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["confirmar"]) && $_POST["confirmar"] === "sim") {
        if (!empty($produto['imagem']) && file_exists('uploads/' . $produto['imagem'])) {
            unlink('uploads/' . $produto['imagem']);
        }
        $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
    }
    header("Location: productos.php");
    exit();
}

include "cabecalho.php";
?>

<h2>Excluir Produto</h2>
<p>Tem certeza que deseja excluir <strong><?= htmlspecialchars($produto['nome']) ?></strong>?</p>

<form method="post">
    <button type="submit" name="confirmar" value="sim" class="btn-excluir">Sim, excluir</button>
    <a href="productos.php" class="btn-cancelar">Cancelar</a>
</form>

</body>
</html>