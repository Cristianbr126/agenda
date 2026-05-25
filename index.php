<?php
require_once "config.php";
include "cabecalho.php";
include_once "funcoes.php";

$pagina = $_GET['pagina'] ?? 1;
$busca  = $_GET['busca'] ?? '';
$porPagina = 5;

$total = totalContatos($pdo, $busca);
$totalPaginas = ceil($total / $porPagina);

$contatos = listarContatosPaginados($pdo, $busca, $pagina, $porPagina);
exibirTabelaContatos($contatos);

// Links de paginação
echo "<div>";
for ($i = 1; $i <= $totalPaginas; $i++) {
    echo "<a href='?pagina=$i&busca=" . urlencode($busca) . "' style='margin:0 5px;'>$i</a> ";
}
echo "</div>";
?>

<form method="get" style="margin-bottom: 20px;">
    <input type="text" name="busca" placeholder="Buscar por nome ou e-mail" value="<?= htmlspecialchars($busca) ?>">
    <button type="submit">Buscar</button>
    <a href="index.php">Limpar</a>
</form>

</body>
</html>