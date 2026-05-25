<?php
// cadastro_produto.php
require_once "config.php";
include "cabecalho.php";

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $preco = trim($_POST['preco'] ?? '');
    $estoque = trim($_POST['estoque'] ?? '');
    
    // Validações básicas
    if ($nome === '') {
        $erro = 'O nome do produto é obrigatório.';
    } elseif (!is_numeric($preco) || $preco <= 0) {
        $erro = 'Preço deve ser um número positivo (ex: 19.90).';
    } elseif (!is_numeric($estoque) || $estoque < 0) {
        $erro = 'Estoque deve ser um número inteiro não negativo.';
    } else {
        // Processar imagem
        $nomeImagem = '';
        if (!empty($_FILES['imagem']['name'])) {
            $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
            $permitidos = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            
            if (!in_array($extensao, $permitidos)) {
                $erro = 'Tipo de arquivo não permitido. Envie JPG, PNG, WEBP ou GIF.';
            } else {
                $nomeImagem = uniqid('prod_') . '.' . $extensao;
                $destino = 'uploads/' . $nomeImagem;
                if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
                    $erro = 'Falha ao fazer upload da imagem.';
                }
            }
        }
        
        if (!$erro) {
            // Inserir no banco (imagem pode ser nula)
            $stmt = $pdo->prepare(
                'INSERT INTO produtos (nome, descricao, preco, estoque, imagem) VALUES (?, ?, ?, ?, ?)'
            );
            $stmt->execute([$nome, $descricao, $preco, $estoque, $nomeImagem]);
            $sucesso = 'Produto cadastrado com sucesso!';
            // Opcional: limpar formulário
            $nome = $descricao = $preco = $estoque = '';
        }
    }
}
?>

<h2>Cadastrar Produto</h2>

<?php if ($erro): ?>
    <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>
<?php if ($sucesso): ?>
    <p style="color: green;"><?= htmlspecialchars($sucesso) ?></p>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">
    <label>Nome:</label><br>
    <input type="text" name="nome" required value="<?= htmlspecialchars($nome ?? '') ?>"><br><br>

    <label>Descrição:</label><br>
    <textarea name="descricao" rows="3" cols="40"><?= htmlspecialchars($descricao ?? '') ?></textarea><br><br>

    <label>Preço (R$):</label><br>
    <input type="number" step="0.01" name="preco" required value="<?= htmlspecialchars($preco ?? '') ?>"><br><br>

    <label>Estoque:</label><br>
    <input type="number" step="1" name="estoque" required value="<?= htmlspecialchars($estoque ?? '') ?>"><br><br>

    <label>Imagem (JPG, PNG, WEBP, GIF):</label><br>
    <input type="file" name="imagem" accept="image/jpeg,image/png,image/webp,image/gif"><br><br>

    <button type="submit">Salvar</button>
</form>

</body>
</html>