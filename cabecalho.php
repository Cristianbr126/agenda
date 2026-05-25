<!-- cabecalho.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestão</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        /* Container principal */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            padding: 30px;
        }

        /* Cabeçalho com gradiente */
        .styilo {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px 30px;
            margin-bottom: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        nav {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            background: rgba(255,255,255,0.2);
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        nav a:hover {
            background: rgba(255,255,255,0.4);
            transform: translateY(-2px);
        }

        /* Títulos */
        h1, h2 {
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #667eea;
            display: inline-block;
        }

        /* Tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px;
            font-weight: 600;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
        }

        tr:hover {
            background: #f5f5f5;
        }

        /* Botões de ação */
        .btn-editar, .btn-excluir {
            display: inline-block;
            padding: 6px 15px;
            margin: 0 3px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-editar {
            background: #ff9800;
            color: white;
        }

        .btn-editar:hover {
            background: #e68900;
            transform: scale(1.05);
        }

        .btn-excluir {
            background: #f44336;
            color: white;
        }

        .btn-excluir:hover {
            background: #da190b;
            transform: scale(1.05);
        }

        /* Botão salvar/atualizar */
        .btn-salvar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-salvar:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        }

        .btn-cancelar {
            background: #999;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-cancelar:hover {
            background: #777;
        }

        /* Formulários */
        form {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
        }

        label {
            font-weight: 600;
            color: #555;
            margin-top: 10px;
            display: block;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102,126,234,0.3);
        }

        /* Paginação */
        .paginacao {
            margin-top: 20px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .paginacao a {
            padding: 8px 14px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .paginacao a:hover {
            background: #764ba2;
            transform: scale(1.05);
        }

        /* Busca */
        .busca {
            margin: 20px 0;
            display: flex;
            gap: 10px;
        }

        .busca input {
            flex: 1;
            margin: 0;
        }

        .busca button {
            background: #667eea;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
        }

        .busca button:hover {
            background: #764ba2;
        }

        /* Mensagens */
        .erro {
            background: #f44336;
            color: white;
            padding: 10px;
            border-radius: 8px;
            margin: 10px 0;
        }

        .sucesso {
            background: #4caf50;
            color: white;
            padding: 10px;
            border-radius: 8px;
            margin: 10px 0;
        }

        /* Imagens dos produtos */
        .produto-imagem {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div class="container">
    <header class="styilo">
        <nav>
            <a href="index.php">🏠 Início</a>
            <a href="cadastro_contacto.php">➕ Novo Contato</a>
            <a href="cadastro_cliente.php">👤 Novo Cliente</a>
            <a href="clientes.php">📋 Clientes</a>
            <a href="productos.php">📦 Produtos</a>
            <a href="cadastro_productos.php">🆕 Novo Produto</a>
        </nav>
    </header>