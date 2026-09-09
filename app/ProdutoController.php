<?php

class ProdutoController
{
    public function __construct(private Produto $produto)
    {
    }

    public function listar(): array
    {
        return $this->produto->listar();
    }

    public function salvar(?array $produto = null): array
    {
        $dados = $produto ?? ['nome' => '', 'descricao' => '', 'preco' => '', 'estoque' => ''];
        $erro = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $this->lerFormulario($dados);
            $erro = $this->validar($dados);
        }

        return compact('dados', 'erro');
    }

    public function buscar(int $id): ?array
    {
        return $this->produto->buscar($id);
    }

    public function criar(array $dados): void
    {
        $this->produto->criar($dados);
    }

    public function atualizar(int $id, array $dados): void
    {
        $this->produto->atualizar($id, $dados);
    }

    public function excluir(int $id): void
    {
        $this->produto->excluir($id);
    }

    public function validar(array $dados): string
    {
        if ($dados['nome'] === '') {
            return 'Informe o nome do produto.';
        }

        if (mb_strlen($dados['nome']) > 120) {
            return 'O nome pode ter no máximo 120 caracteres.';
        }

        if (mb_strlen($dados['descricao']) > 1000) {
            return 'A descrição pode ter no máximo 1000 caracteres.';
        }

        if ($dados['preco'] === null || !is_numeric($dados['preco']) || $dados['preco'] < 0 || $dados['preco'] > 99999999.99) {
            return 'Informe um preço válido entre R$ 0,00 e R$ 99.999.999,99.';
        }

        if (filter_var($dados['estoque'], FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 0, 'max_range' => 2147483647]
        ]) === false) {
            return 'Informe um estoque inteiro entre 0 e 2.147.483.647.';
        }
        return '';
    }

    private function lerFormulario(array $dados): array
    {
        return [
            'nome' => trim($_POST['nome'] ?? $dados['nome']),
            'descricao' => trim($_POST['descricao'] ?? $dados['descricao']),
            'preco' => $this->normalizarPreco($_POST['preco'] ?? $dados['preco']),
            'estoque' => trim($_POST['estoque'] ?? $dados['estoque'])
        ];
    }

    private function normalizarPreco(string $preco): ?string
    {
        $preco = preg_replace('/\s+/', '', trim($preco));
        $preco = preg_replace('/^R\$/i', '', $preco);
        if ($preco === '') {
            return null;
        }

        if (str_contains($preco, ',')) {
            $formatoBrasileiro = '/^\d{1,3}(\.\d{3})*,\d{1,2}$/';
            $formatoSimples = '/^\d+,\d{1,2}$/';

            if (!preg_match($formatoBrasileiro, $preco) && !preg_match($formatoSimples, $preco)) {
                return null;
            }

            return str_replace(',', '.', str_replace('.', '', $preco));
        }

        if (!preg_match('/^\d+(\.\d{1,2})?$/', $preco)) {
            return null;
        }

        return $preco;
    }
}
