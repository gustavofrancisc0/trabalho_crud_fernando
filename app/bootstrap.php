<?php

require_once __DIR__ . '/conexao.php';
require_once __DIR__ . '/Produto.php';
require_once __DIR__ . '/ProdutoController.php';

$controller = new ProdutoController(new Produto($pdo));

function e($valor): string
{
	return htmlspecialchars((string) ($valor ?? ''), ENT_QUOTES, 'UTF-8');
}