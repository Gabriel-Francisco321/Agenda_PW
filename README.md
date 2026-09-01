# Agenda PW 

Personal web calendar application developed in PHP with MySQL, for registering users and managing tasks such as scheduling, searching, editing, completing, and deleting.

## Features

- User registration
- Login and logout
- Add tasks
- List tasks by user
- Search tasks by title
- Mark task as completed
- Delete tasks
- View the next pending task

## Technologies

- PHP 8+
- MySQL / MariaDB
- HTML5
- CSS3
- JavaScript
- XAMPP (recommended environment for local execution)

## Project Structure

```text
Agenda_PW/
├── auth/
│ ├── cadastro.php
│ ├── login.php
│ └── logout.php
├── classes/
│ ├── Apontamento.php
│ └── Usuario.php
├── config/
│ └── database.php
├── css/
│ └── style.css
├── dashboard/
│ ├── add.php
│ ├── change.php
│ ├── complete.php
│ └── delete.php
├── img/
├── js/
│ └── scripts.js
├── migration/
│ └── agenda.sql
├── index.php
├── .gitignore
└── README.md
```

## Prerequisites

- XAMPP installed
- PHP and MySQL active in XAMPP
- Web browser
- Create the folder in: `c:/xampp/htdocs/`

## Database Configuration

1. Start Apache and MySQL in XAMPP.

2. Access phpMyAdmin at: http://localhost/phpmyadmin
3. Import the file located in `migration/agenda.sql`.

The script creates the database `agenda`, the tables `usuarios` and `apontamentos`, and also prepares some initial database configurations.

## Connection Configuration

The connection file is in `config/database.php`.

If your environment has different credentials, adjust these lines:

```php
private static $dsn = "mysql:host=localhost;dbname=agenda;chaset=utf8mb4";

private static $user = "root";

private static $senha = "";

```

## Application Execution

1. Open the project folder within the XAMPP directory, normally:

```text
C:\xampp\htdocs\Agenda_PW

```

2. Start Apache in XAMPP.

3. Access in your browser:

```text
http://localhost/Agenda_PW

```

4. If you don't have an account, go to:

```text
http://localhost/Agenda_PW/auth/cadastro.php

```

## Usage Flow

1. Create an account.

2. Log in.

3. Add tasks through the main interface.

4. Use the search to locate tasks by name.

5. Mark tasks as completed when necessary.

6. Edit or delete records as needed.

## Important Notes

- The application uses sessions to keep the user authenticated.

- The project relies on absolute paths in some files, so it's important to keep the project in the correct XAMPP folder.

- The navigation and authentication logic is in `index.php`, `auth/`, and `dashboard/`.

## License

This project is intended for educational and demonstration purposes.

## Developer

Project in progress for personal task and routine organization.