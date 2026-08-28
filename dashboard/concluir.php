<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    exit();
}

include 'C:\xampp\htdocs\Agenda_PW\classes\Apontamento.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

$apontamento = Apontamento::find($id);

$apontamento->setEstado('FINALIZADO');
$apontamento->update();

header('Location: ../index.php');
exit();
