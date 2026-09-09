<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($rotulo) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5">
    <h1 class="mb-4"><?= e($rotulo) ?></h1>
    <?php if ($erro): ?><div class="alert alert-danger"><?= e($erro) ?></div><?php endif; ?>
    <form method="post" class="card card-body shadow-sm">
        <?php if (isset($id)): ?><input type="hidden" name="id" value="<?= e($id) ?>"><?php endif; ?>
        <label class="form-label">Nome</label>
        <input class="form-control mb-3" name="nome" value="<?= e($dados['nome']) ?>" maxlength="120" required>
        <label class="form-label">Descrição</label>
        <textarea class="form-control mb-3" name="descricao" rows="3" maxlength="1000"><?= e($dados['descricao']) ?></textarea>
        <label class="form-label">Preço</label>
        <div class="input-group mb-3"><span class="input-group-text">R$</span>
            <input class="form-control" type="text" name="preco" inputmode="decimal" placeholder="0,00" value="<?= e(is_numeric($dados['preco']) ? number_format((float) $dados['preco'], 2, ',', '.') : $dados['preco']) ?>" maxlength="13" required>
        </div>
        <label class="form-label">Estoque</label>
        <input class="form-control mb-4" type="number" name="estoque" min="0" max="2147483647" step="1" value="<?= e($dados['estoque']) ?>" required>
        <div><button class="btn btn-primary">Salvar</button> <a class="btn btn-secondary" href="index.php">Cancelar</a></div>
    </form>
</main>
<script>
const campoPreco = document.querySelector('[name="preco"]');
campoPreco.addEventListener('input', function () {
    let valor = this.value.replace(/\D/g, '');
    if (!valor) { this.value = ''; return; }
    if (Number(valor) / 100 > 99999999.99) valor = '9999999999';
    this.value = (Number(valor) / 100).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
});
</script>
</body>
</html>
