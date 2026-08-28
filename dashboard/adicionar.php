<?php 

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Agenda_PW/auth/login.php');
    exit();
}

$titulo = $_POST['titulo'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$data = $_POST['data'] ?? null;
$inicio = $_POST['inicio'] ?? null;
$fim = $_POST['fim'] ?? null;

if ($titulo && $descricao && $data && $inicio && $fim) {
    include 'C:\xampp\htdocs\Agenda_PW\classes\Apontamento.php';
    $apontamento = new Apontamento($titulo, $descricao, $data, $inicio, $fim, 'agendado', $_SESSION['user_id']);
    $apontamento->save();

    header('Location: http://localhost/Agenda_PW/index.php');
}else {
    echo "Todos os campos são obrigatórios.";
}

?>