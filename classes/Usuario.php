<?php 

require_once 'C:\xampp\htdocs\Agenda_PW\config\database.php';

class Usuario extends Entity
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;

    // construtor -------------------------------
    public function __construct(string|null $nome=null, string|null $email=null, string|null $senha=null, int|null $id =null)
    {
        
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
            $stmt = self::getPDO()->prepare($sql);
            $stmt->execute([
                $this->nome,
                $this->email,
                $this->senha
            ]);

            $this->id = self::getPDO()->lastInsertId();
            
        }
    }

    public static function find(int $id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = ?;";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->execute([
            $id
        ]);

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($user)) {
            return null;
        }

        return self::entityToClass($user[0]);
    }

    public static function all()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=agenda;charset=utf8mb4', 'root', '');

        $sql = "SELECT * FROM usuarios;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($users)) {
            return [];
        }

        foreach ($users as $key => $user) {
            $users[$key] = self::entityToClass($user);
        }

        return $users;
    }

    public static function findByEmail(string $email)
    {

        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->execute([
            $email
        ]);

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($user)) {
            return null;
        }

        return self::entityToClass($user[0]);
    }

    public static function existEmail(string $email): bool
    {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->execute([
            $email
        ]);

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        return !empty($user);
    }

    public function update()
    {
        if (empty($this->nome) || empty($this->email) || empty($this->senha)) {
            return "Campos vazios!";
        } else {
            $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?;";
            $stmt = self::getPDO()->prepare($sql);
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
        $stmt = self::getPDO()->prepare($sql);
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
    
}

?>