<?php
require_once "config.php";
include "cabecalho.php";
include_once "funcoes_productos.php";  // ← esse é o nome do seu arquivo

$produtos = obterProdutos($pdo);       // ← agora a função existe
exibirTabelaProdutos($produtos);
?>
</body>
</html>