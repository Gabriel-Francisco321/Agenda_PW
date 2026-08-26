<?php 

// class Apontamento
// {
//     private string $titulo;
//     private string $descricao;
//     private string $;

//     private PDO $pdo;

//     // construtor -------------------------------
//     public function __construct(PDO $pdo, string|null $nome=null, string|null $email=null, string|null $senha=null)
//     {
//         $this->nome = $nome;
//         $this->email = $email;
//         $this->senha = $senha;
//         $this->pdo = $pdo;
//     }

//     // setters -----------------------------------
//     public function setNome(string $nome)
//     {
//         $this->nome = $nome;
//     }
//     public function setEmail(string $email)
//     {
//         $this->email = $email;
//     }
//     public function setSenha(string $senha)
//     {
//         $this->senha = $senha;
//     }

//     // getters -----------------------------------
//     public function getNome()
//     {
//         return $this->nome;
//     }
//     public function getEmail()
//     {
//         return $this->email;
//     }
//     public function getSenha()
//     {
//         return $this->senha;
//     }

//     // methodos ------------------------------------
//     public function save()
//     {
//         if (empty($this->nome) || empty($this->email) || empty($this->senha)) {
//             return "Campos vazios!";
//         } else {
//             $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?);";
//             $stmt = $this->pdo->prepare($sql);
//             $stmt->execute([
//                 $this->nome,
//                 $this->email,
//                 $this->senha
//             ]);
//         }
//     }

//     public function find(int $id)
//     {
//         $sql = "SELECT * FROM usuarios WHERE id = ?;";
//         $stmt = $this->pdo->prepare($sql);
//         $user = $stmt->execute([
//             $id
//         ]);

//         return $user;
//     }

//     public function all()
//     {
//         $sql = "SELECT * FROM usuarios;";
//         $stmt = $this->pdo->prepare($sql);
//         $user = $stmt->execute();

//         return $user;
//     }

//     public function findByEmail(string $email)
//     {
//         $sql = "SELECT * FROM usuarios WHERE email = ?";
//         $stmt = $this->pdo->prepare($sql);
//         $user = $stmt->execute([
//             $email
//         ]);

//         return $user;
//     }

//     public function update(int $id)
//     {
//         if (empty($this->nome) || empty($this->email) || empty($this->senha)) {
//             return "Campos vazios!";
//         } else {
//             $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?;";
//             $stmt = $this->pdo->prepare($sql);
//             $stmt->execute([
//                 $this->nome,
//                 $this->email,
//                 $this->senha,
//                 $id
//             ]);
//         }
//     }

//     public function delete(int $id)
//     {
//         $sql = "DELETE FROM usuarios WHERE id = ?;";
//         $stmt = $this->pdo->prepare($sql);
//         $user = $stmt->execute([
//             $id
//         ]);

//         return $user;
//     }
    
// }

?>