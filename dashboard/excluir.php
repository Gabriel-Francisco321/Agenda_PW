<?php 

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Agenda_PW/auth/login.php');
    exit();
}

include 'C:\xampp\htdocs\Agenda_PW\classes\Apontamento.php';
$apontamento = Apontamento::find($_GET['id']);
$apontamento->delete();

header('Location: http://localhost/Agenda_PW/index.php');
