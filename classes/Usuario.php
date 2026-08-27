<?php 

include 'C:\xampp\htdocs\Cursophp\pprojects\Agenda_PW\config\database.php';

class Usuario extends Entity
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;

    // construtor -------------------------------
    public function __construct(string|null $nome=null, string|null $email=null, string|null $senha=null, int|null $id =null)
    {
        parent::__construct();
        
        if (!empty($id)) {
            $this->id = $id;
        }
        if (!empty($senha)) {
            $this->senha = $senha;
        }
        if (!empty($email)) {
            $this->email = $email;
        }
        if (!empty($nome)) {
            $this->nome = $nome;
        }
    }

    // setters -----------------------------------
    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }

    // getters -----------------------------------
    public function getNome()
    {
        return $this->nome;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getSenha()
    {
        return $this->senha;
    }

    // methodos ------------------------------------
    public function save()
    {
        if (empty($this->nome) || empty($this->email) || empty($this->senha)) {
            return "Campos vazios!";
        } else {
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?);";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $this->nome,
                $this->email,
                $this->senha
            ]);

            $this->find($this->pdo->lastInsertId());
        }
    }

    public function find(int $id): void
    {
        $sql = "SELECT * FROM usuarios WHERE id = ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $id
        ]);

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        $this->entityToThis($user);
    }

    public function all()
    {
        $sql = "SELECT * FROM usuarios;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function findByEmail(string $email): void
    {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $email
        ]);

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        $this->entityToThis($user);
    }

    public function existEmail(string $email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $email
        ]);

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        return empty($user);
    }

    public function update()
    {
        if (empty($this->nome) || empty($this->email) || empty($this->senha)) {
            return "Campos vazios!";
        } else {
            $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $this->nome,
                $this->email,
                $this->senha,
                $this->id
            ]);
        }
    }

    public function delete()
    {
        $sql = "DELETE FROM usuarios WHERE id = ?;";
        $stmt = $this->pdo->prepare($sql);
        $user = $stmt->execute([
            $this->id
        ]);

        return $user;
    }

    public static function entityToClass(Array $user)
    {
        $usuario = new Usuario($user['nome'], $user['email'], $user['senha'], $user['id']);
        return $usuario;
    }

    private function entityToThis(Array $user): void
    {
        $this->nome = $user['nome'];
        $this->email = $user['email'];
        $this->senha = $user['senha'];
        $this->id = $user['id'];
    }
    
}

?>