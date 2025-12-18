# Cadastro de contatos

Uma aplicação full-stack para gerenciamento de contatos, permitindo:

- Listar contatos
- Criar novos contatos
- Editar contatos existentes
- Excluir contatos

Com validações implementadas tanto no frontend quanto no backend.

## Tecnologias utilizadas

- **Frontend:** React, Vite, TypeScript, Tailwind CSS, React Hook Form
- **Backend:** PHP
- **Banco de dados:** MySQL

## Pré-requisitos

Antes de rodar o projeto, você precisa ter instalado:

- PHP 7.4+ devido as propriedades tipadas (recomendado 8+)
- MySQL 5+ (recomendado 5.7+)
- Node.js v22.14+
- npm

## Executando o dump do banco de dados

1. Clone o repositório:

```bash
git clone https://github.com/zNathan2303/crud-contatos-teste-conhecimento.git
```

2. Navegue até a raiz do projeto, onde está o arquivo `dump-banco.sql`.

3. Realize o dump do banco de dados.

Caso seu mysql esteja nas variáveis de ambiente:

```bash
mysql -u seu_usuario -p < dump-banco.sql
```

Caso não esteja:

```bash
"C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql.exe" -u seu_usuario -p < dump-banco.sql
```

4. Será pedido a senha do usuário, então coloque-a.
5. Após isso, será criado o banco de dados e ele será populado com dados iniciais.

## Executando o Backend

Certifique-se de os drivers do mysql estarem habilitados no arquivo `php.ini`:

1. Para localizar o `php.ini`:

```bash
php --ini
```

2. Drivers que devem estar habilitados:

```
extension=mysqli
extension=pdo_mysql
```

3. Na raiz do projeto, navegue para a pasta do backend:

```bash
cd backend
```

Em `src/Repositories/ContatoRepository.php` configure as credenciais de um usuário do MySQL com permissões para realizar operações no banco:

```php
$pdo = new PDO(
    'mysql:host=localhost;dbname=db_cadastro_contatos',
    'root',     <- O usuário
    'bcd127'    <- A senha do usuário
);
```

4. Execute o servidor local do PHP:

```bash
php -S localhost:8080
```

O backend estará disponível em http://localhost:8080.

## Executando o Frontend

1. Na raiz do projeto, entre na pasta `frontend`:

```bash
cd frontend
```

2. Instale as dependências:

```bash
npm install
```

3. Execute o projeto:

```bash
npm run dev
```

## Autor

[Nathan da Silva Costa](https://www.linkedin.com/in/nathandasilvacosta/)
