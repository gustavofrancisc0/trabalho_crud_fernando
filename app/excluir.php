<?php
require_once 'bootstrap.php';
$id = (int) ($_GET['id'] ?? 0);
if ($id > 0) { $controller->excluir($id); }
header('Location: index.php?sucesso=1');
exit;
