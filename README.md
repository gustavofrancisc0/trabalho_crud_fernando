# Versão 4 - CRUD de Produtos com PHP e MySQL

Versão final da aplicação web para cadastrar, consultar, editar e excluir produtos. O projeto usa PHP, MySQL e Docker Compose.

## Autores

- Gladson Coronado dos Santos
- Gustavo Francisco dos Santos

## Tecnologias

- PHP 8.2 com Apache
- MySQL 8.0
- Docker Compose
- PDO
- Bootstrap 5

## Pré-requisitos

É necessário ter Docker e Docker Compose instalados. Não é necessário instalar PHP ou MySQL localmente.

## Como executar

```bash
git clone https://github.com/mcmcmcmcgladsoncoronado-art/trabalho_crud_fernando.git
cd trabalho_crud_fernando
docker compose up -d --build
```

Acesse `http://localhost:8080`.

A tabela `produtos` é criada automaticamente pelo arquivo `app/conexao.php` na primeira conexão com o banco.

Para parar os containers:

```bash
docker compose down
```

## Estrutura simples

```text
app/
├── conexao.php             # Conecta ao MySQL e cria a tabela
├── Produto.php             # Consultas SQL do CRUD
├── ProdutoController.php   # Validações e regras do fluxo
├── bootstrap.php           # Carrega as classes da aplicação
├── formulario.php          # HTML dos formulários
├── index.php               # Lista os produtos
├── criar.php               # Cadastra um produto
├── editar.php              # Edita um produto
└── excluir.php             # Exclui um produto
```

Todos os arquivos ficam diretamente em `app/` para manter o projeto fácil de entender. O `ProdutoController.php` organiza as validações, o `Produto.php` concentra as consultas e o `conexao.php` cuida do banco, sem usar API ou framework.

## Docker Compose

O serviço `app` usa PHP 8.2 com Apache, instala a extensão `pdo_mysql` e expõe a porta 80 do container na porta 8080 do computador.

O serviço `db` usa a imagem oficial `mysql:8.0`. As variáveis `DB_HOST`, `DB_NAME`, `DB_USER` e `DB_PASSWORD` são configuradas diretamente no `docker-compose.yml`, sem arquivo `.env`.

O volume `mysql-dados` mantém os dados do banco quando os containers são reiniciados. A rede `crud-rede`, com driver `bridge`, permite a comunicação entre a aplicação e o MySQL pelo nome `db`.

## Funcionalidades

- Listagem de produtos.
- Cadastro via POST.
- Edição com formulário pré-carregado.
- Exclusão com confirmação.
- Máscara monetária no preço.
- Validação de nome, descrição, preço e estoque.
- Exibição da data de cadastro na listagem final.

## Pontos interessantes

1. Usamos Docker Compose para executar PHP e MySQL juntos.
2. O volume preserva os produtos cadastrados.
3. A rede personalizada permite a comunicação entre os containers.
4. Usamos PDO e consultas preparadas.
5. Mantivemos controller e model sem criar uma estrutura complexa.

## Requisitos atendidos

O projeto possui os serviços `app` e `db`, variáveis de ambiente, porta mapeada, volume persistente, rede bridge personalizada, CRUD completo, comentários didáticos no Compose e documentação de execução.
