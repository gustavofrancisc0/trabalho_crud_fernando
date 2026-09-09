<?php
require_once 'bootstrap.php';
$dados = ['nome' => '', 'descricao' => '', 'preco' => '', 'estoque' => ''];
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ['dados' => $dados, 'erro' => $erro] = $controller->salvar();
    if ($erro === '') {
        $controller->criar($dados);
        header('Location: index.php?sucesso=1');
        exit;
    }
}
$rotulo = 'Cadastrar produto';
require 'formulario.php';
