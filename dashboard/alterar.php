<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Cursophp/pprojects/Agenda_PW/auth/login.php');
    exit();
}

include 'C:\xampp\htdocs\Cursophp\pprojects\Agenda_PW\classes\Apontamento.php';
$apontamento = new Apontamento();
$apontamento->find($_GET['id']);

$titulo = $_POST['titulo'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$data = $_POST['data'] ?? null;
$inicio = $_POST['inicio'] ?? null;
$fim = $_POST['fim'] ?? null;

if ($titulo && $descricao && $data && $inicio && $fim) {
    $apontamento->setTitulo($titulo);
    $apontamento->setDescricao($descricao);
    $apontamento->setData($data);
    $apontamento->setInicio($inicio);
    $apontamento->setFim($fim);
    $apontamento->update();

    header('Location: http://localhost/Cursophp/pprojects/Agenda_PW/index.php');
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Apontamento</title>
</head>

<body>
    <form action="#" method="post">
        <input type="text" name="titulo" id="titulo" placeholder="Titulo" value="<?php echo $apontamento->getTitulo(); ?>"><br>
        <input type="text" name="descricao" id="descricao" placeholder="Descrição" value="<?php echo $apontamento->getDescricao(); ?>"><br>
        <input type="date" name="data" id="data" value="<?php echo $apontamento->getData(); ?>"><br>
        <input type="time" name="inicio" id="inicio" value="<?php echo $apontamento->getInicio(); ?>"><br>
        <input type="time" name="fim" id="fim" value="<?php echo $apontamento->getFim(); ?>"><br>
        <input type="submit" value="Alterar">
    </form>
</body>

</html>