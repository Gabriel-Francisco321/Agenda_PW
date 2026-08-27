<?php 

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Cursophp/pprojects/Agenda_PW/auth/login.php');
    exit();
}

session_destroy();
header('Location: http://localhost/Cursophp/pprojects/Agenda_PW/auth/login.php');

?>