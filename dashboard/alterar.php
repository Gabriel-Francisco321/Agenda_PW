<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Agenda_PW/auth/login.php');
    exit();
}

include 'C:\xampp\htdocs\Agenda_PW\classes\Apontamento.php';
$apontamento = Apontamento::find($_GET['id']);

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

    header('Location: http://localhost/Agenda_PW/index.php');
}
