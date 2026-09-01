# Agenda PW

Aplicação web de agenda pessoal desenvolvida em PHP com MySQL, para cadastrar usuários e gerenciar tarefas como agendar, pesquisar, editar, concluir e excluir.

## Funcionalidades

- Cadastro de usuários
- Login e logout
- Adicionar tarefas
- Listar tarefas por usuário
- Pesquisar tarefas por título
- Marcar tarefa como concluída
- Excluir tarefas
- Exibir a próxima tarefa pendente

## Tecnologias

- PHP 8+
- MySQL / MariaDB
- HTML5
- CSS3
- JavaScript
- XAMPP (ambiente recomendado para execução local)

## Estrutura do projeto

```text
Agenda_PW/
├── auth/
│   ├── cadastro.php
│   ├── login.php
│   └── logout.php
├── classes/
│   ├── Apontamento.php
│   └── Usuario.php
├── config/
│   └── database.php
├── css/
│   └── style.css
├── dashboard/
│   ├── adicionar.php
│   ├── alterar.php
│   ├── concluir.php
│   └── excluir.php
├── img/
├── js/
│   └── scripts.js
├── migration/
│   └── agenda.sql
├── index.php
├── .gitignore
└── README.md
```

## Pré-requisitos

- XAMPP instalado
- PHP e MySQL ativos no XAMPP
- Navegador web
- Criar a pasta em: `c:/xampp/htdocs/`

## Configuração do banco de dados

1. Inicie o Apache e o MySQL no XAMPP.
2. Acesse o phpMyAdmin em: http://localhost/phpmyadmin
3. Importe o arquivo localizado em `migration/agenda.sql`.

O script cria a base de dados `agenda`, as tabelas `usuarios` e `apontamentos` e também já prepara algumas configurações iniciais do banco.

## Configuração da conexão

O arquivo de conexão está em `config/database.php`.

Caso seu ambiente tenha credenciais diferentes, ajuste estas linhas:

```php
private static $dsn = "mysql:host=localhost;dbname=agenda;chaset=utf8mb4";
private static $user = "root";
private static $password = "";
```

## Execução da aplicação

1. Abra a pasta do projeto dentro do diretório do XAMPP, normalmente:

```text
C:\xampp\htdocs\Agenda_PW
```

2. Inicie o Apache no XAMPP.
3. Acesse no navegador:

```text
http://localhost/Agenda_PW
```

4. Caso não tenha conta, vá para:

```text
http://localhost/Agenda_PW/auth/cadastro.php
```

## Fluxo de uso

1. Crie uma conta.
2. Faça login.
3. Adicione tarefas pela interface principal.
4. Use a pesquisa para localizar tarefas por nome.
5. Marque tarefas como concluídas quando necessário.
6. Edite ou exclua registros conforme a necessidade.

## Observações importantes

- A aplicação usa sessões para manter o usuário autenticado.
- O projeto depende de caminhos absolutos em alguns arquivos, por isso é importante manter o projeto na pasta correta do XAMPP.
- A lógica de navegação e autenticação está em `index.php`, `auth/` e `dashboard/`.

## Licença

Este projeto é destinado a fins educacionais e de demonstração.

## Desenvolvedor

Projeto em andamento para organização pessoal de tarefas e rotina.
