<?php 

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if ($email && $password) {
    include 'C:\xampp\htdocs\Cursophp\pprojects\Agenda_PW\classes\Usuario.php';
    $user = new Usuario();
    $user->findByEmail($email);
    if ($user->getSenha() === $password) {
        session_start();
        $_SESSION['user_id'] = $user->getId();
        header('Location: C:\xampp\htdocs\Cursophp\pprojects\Agenda_PW\index.php');
    }else {
        echo "senha incorreta";
    }
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <form action="#" method="post">
        <input type="email" name="email" id="email" placeholder="Email"><br>
        <input type="password" name="password" id="password" placeholder="Senha"><br>
        <input type="submit" value="enviar">
    </form>

</body>
</html>