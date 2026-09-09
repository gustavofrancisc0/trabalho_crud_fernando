<?php
require_once 'bootstrap.php';
$produtos = $controller->listar();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Cadastro de produtos</h1>
        <a href="criar.php" class="btn btn-primary">Novo produto</a>
    </div>
    <?php if (isset($_GET['sucesso'])): ?><div class="alert alert-success">Operação realizada com sucesso.</div><?php endif; ?>
    <div class="card shadow-sm"><div class="card-body">
        <?php if (!$produtos): ?>
            <p class="text-muted mb-0">Nenhum produto cadastrado.</p>
        <?php else: ?>
            <div class="table-responsive"><table class="table table-hover align-middle mb-0">
                <thead><tr><th>ID</th><th>Nome</th><th>Descrição</th><th>Preço</th><th>Estoque</th><th>Ações</th></tr></thead>
                <tbody><?php foreach ($produtos as $produto): ?><tr>
                    <td><?= e($produto['id']) ?></td><td class="fw-semibold"><?= e($produto['nome']) ?></td>
                    <td><?= e($produto['descricao']) ?></td><td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td><?= e($produto['estoque']) ?></td><td class="text-muted">Edição e exclusão serão adicionadas na próxima etapa.</td>
                </tr><?php endforeach; ?></tbody>
            </table></div>
        <?php endif; ?>
    </div></div>
</main>
</body>
</html>
