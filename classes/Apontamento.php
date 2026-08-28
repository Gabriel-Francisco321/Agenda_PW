<?php 

require_once 'C:\xampp\htdocs\Agenda_PW\config\database.php';

class Apontamento extends Entity
{
    private int $id;
    private string $titulo;
    private string $descricao;
    private string $data;
    private string $inicio;
    private string $fim;
    private string $estado;
    private int $id_usuario;

    // construtor -------------------------------
    public function __construct(string|null $titulo=null, string|null $descricao=null, string|null $data=null, string|null $inicio=null, string|null $fim=null, string|null $estado=null, int|null $id_usuario=null, int|null $id =null)
    {
        if (!empty($id)) {
            $this->id = $id;
        }
        if (!empty($data)) {
            $this->data = $data;
        }
        if (!empty($descricao)) {
            $this->descricao = $descricao;
        }
        if (!empty($titulo)) {
            $this->titulo = $titulo;
        }
        if (!empty($inicio)) {
            $this->inicio = $inicio;
        }
        if (!empty($fim)) {
            $this->fim = $fim;
        }
        if (!empty($estado)) {
            $this->estado = $estado;
        }
        if (!empty($id_usuario)) {
            $this->id_usuario = $id_usuario;
        }
    }

    // setters -----------------------------------
    public function setTitulo(string $titulo)
    {
        $this->titulo = $titulo;
    }
    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;
    }
    public function setData(string $data)
    {
        $this->data = $data;
    }
    public function setInicio(string $inicio)
    {
        $this->inicio = $inicio;
    }
    public function setFim(string $fim)
    {
        $this->fim = $fim;
    }
    public function setEstado(string $estado)
    {
        $this->estado = $estado;
    }
    public function setIdUsuario(int $id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    // getters -----------------------------------
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function getData()
    {
        return $this->data;
    }
    public function getInicio()
    {
        return $this->inicio;
    }
    public function getFim()
    {
        return $this->fim;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    // methodos ------------------------------------
    public function save()
    {
        if (empty($this->titulo) || empty($this->descricao) || empty($this->data) || empty($this->inicio) || empty($this->fim) || empty($this->estado) || empty($this->id_usuario)) {
            return "Campos vazios!";
        } else {
            $sql = "INSERT INTO apontamentos (titulo, descricao, data, inicio, fim, estado, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?);";
            $stmt = self::getPDO()->prepare($sql);
            $stmt->execute([
                $this->titulo,
                $this->descricao,
                $this->data,
                $this->inicio,
                $this->fim,
                $this->estado,
                $this->id_usuario
            ]);

            $this->id = self::getPDO()->lastInsertId();
        }
    }

    public static function find(int $id): Apontamento
    {
        $sql = "SELECT * FROM apontamentos WHERE id = ?;";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->execute([
            $id
        ]);

        $apontamento = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        return self::entityToClass($apontamento);
    }

    public static function findByUserId(int $id_usuario): array
    {

        $sql = "SELECT * FROM apontamentos WHERE id_usuario = ? AND estado != ?;";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->execute([
            $id_usuario,
            'FINALIZADO'
        ]);

        $apontamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($apontamentos as $key => $apontamento) {
            $apontamentos[$key] = self::entityToClass($apontamento);
        }

        return $apontamentos;
    }

    public static function all()
    {

        $sql = "SELECT * FROM apontamentos;";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->execute();

        $apontamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($apontamentos as $key => $apontamento) {
            $apontamentos[$key] = self::entityToClass($apontamento);
        }

        return $apontamentos;
    }

    public function update()
    {
        if (empty($this->titulo) || empty($this->descricao) || empty($this->data) || empty($this->inicio) || empty($this->fim) || empty($this->estado) || empty($this->id_usuario)) {
            return "Campos vazios!";
        } else {
            $sql = "UPDATE apontamentos SET titulo = ?, descricao = ?, data = ?, inicio = ?, fim = ?, estado = ?, id_usuario = ? WHERE id = ?;";
            $stmt = self::getPDO()->prepare($sql);
            $stmt->execute([
                $this->titulo,
                $this->descricao,
                $this->data,
                $this->inicio,
                $this->fim,
                $this->estado,
                $this->id_usuario,
                $this->id
            ]);
        }
    }

    public function delete()
    {
        $sql = "DELETE FROM apontamentos WHERE id = ?;";
        $stmt = self::getPDO()->prepare($sql);
        $apontamento = $stmt->execute([
            $this->id
        ]);

        return $apontamento;
    }

    public static function entityToClass(Array $apontamentoentity): Apontamento
    {
        $apontamento = new self($apontamentoentity['titulo'], $apontamentoentity['descricao'], $apontamentoentity['data'], $apontamentoentity['inicio'], $apontamentoentity['fim'], $apontamentoentity['estado'], $apontamentoentity['id_usuario'], $apontamentoentity['id']);
        return $apontamento;
    }
    
}
