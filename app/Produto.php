<?php

class Produto
{
    public function __construct(private PDO $pdo)
    {
    }

    public function listar(): array
    {
        return $this->pdo->query('SELECT * FROM produtos ORDER BY id DESC')->fetchAll();
    }

    public function buscar(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM produtos WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function criar(array $dados): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO produtos (nome, descricao, preco, estoque) VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$dados['nome'], $dados['descricao'], $dados['preco'], $dados['estoque']]);
    }

    public function atualizar(int $id, array $dados): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE produtos SET nome = ?, descricao = ?, preco = ?, estoque = ? WHERE id = ?'
        );
        $stmt->execute([$dados['nome'], $dados['descricao'], $dados['preco'], $dados['estoque'], $id]);
    }

    public function excluir(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM produtos WHERE id = ?');
        $stmt->execute([$id]);
    }
}