<?php 

include 'C:\xampp\htdocs\Cursophp\pprojects\Agenda_PW\classes\Usuario.php';

$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if ($email && $name && $password) {
    $user = new Usuario($name, $email, $password);
    $user->save();

    session_start();
    $_SESSION['user_id'] = $user->getId();
    header('Location: C:\xampp\htdocs\Cursophp\pprojects\Agenda_PW\index.php');
}else {
    
    $mensage = "preencha todos os campos.";
    
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <form action="#" method="post">
        <input type="text" name="name" id="name" placeholder="Nome"><br>
        <input type="email" name="email" id="email" placeholder="Email"><br>
        <input type="password" name="password" id="password" placeholder="Senha"><br>
        <input type="submit" value="enviar">
    </form>
    <?php 
    if (!empty($mensage)) {
        echo "
        <div style='color: red;'>
            <p>$mensage</p>
        </div>
        ";
    }
    ?>
</body>
</html>