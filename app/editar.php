<?php
require_once 'bootstrap.php';
$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);
$produto = $controller->buscar($id);
if (!$produto) { http_response_code(404); die('Produto não encontrado.'); }
$dados = $produto;
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ['dados' => $dados, 'erro' => $erro] = $controller->salvar($produto);
    if ($erro === '') {
        $controller->atualizar($id, $dados);
        header('Location: index.php?sucesso=1');
        exit;
    }
}
$rotulo = 'Editar produto';
require 'formulario.php';
