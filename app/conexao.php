<?php

$host = getenv('DB_HOST') ?: 'db';
$database = getenv('DB_NAME') ?: 'produtos';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: 'root';

for ($tentativa = 1; $tentativa <= 10; $tentativa++) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        $pdo->exec("CREATE TABLE IF NOT EXISTS produtos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(120) NOT NULL,
            descricao TEXT,
            preco DECIMAL(10,2) NOT NULL,
            estoque INT NOT NULL DEFAULT 0,
            data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
        break;
    } catch (PDOException $erro) {
        if ($tentativa === 10) die('Não foi possível conectar ao banco. Atualize a página em alguns segundos.');
        sleep(2);
    }
}
