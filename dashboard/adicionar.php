<?php 

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Cursophp/pprojects/Agenda_PW/auth/login.php');
    exit();
}

$titulo = $_POST['titulo'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$data = $_POST['data'] ?? null;
$inicio = $_POST['inicio'] ?? null;
$fim = $_POST['fim'] ?? null;

if ($titulo && $descricao && $data && $inicio && $fim) {
    include 'C:\xampp\htdocs\Cursophp\pprojects\Agenda_PW\classes\Apontamento.php';
    $apontamento = new Apontamento($titulo, $descricao, $data, $inicio, $fim, 'agendado', $_SESSION['user_id']);
    $apontamento->save();

    header('Location: http://localhost/Cursophp/pprojects/Agenda_PW/index.php');
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Apontamento</title>
</head>
<body>
    <form action="#" method="post">
        <input type="text" name="titulo" id="titulo" placeholder="Titulo"><br>
        <input type="text" name="descricao" id="descricao" placeholder="Descrição"><br>
        <input type="date" name="data" id="data"><br>
        <input type="time" name="inicio" id="inicio"><br>
        <input type="time" name="fim" id="fim"><br>
        <input type="submit" value="Adicionar">
    </form>
</body>
</html>