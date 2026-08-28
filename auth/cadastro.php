<?php 

include 'C:\xampp\htdocs\Agenda_PW\classes\Usuario.php';

$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (trim($email) && trim($name) && trim($password)) {

    if (Usuario::existEmail($email)) {
        $message = "email já cadastrado.";
    } else {
        $user = new Usuario(trim($name), trim($email), trim($password));
        $user->save();

        session_start();
        $_SESSION['user_id'] = $user->getId();
        header('Location: http://localhost/Agenda_PW/index.php');
    }
}else {
    
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
        $message = "preencha todos os campos.";
    }
    
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="auth-page">
    <main class="auth-card">
        <a href="../index.php" class="auth-brand">
            <strong>Agenda</strong>
        </a>

        <h1>Crie sua conta</h1>
        <p class="auth-subtitle">Preencha os dados abaixo para começar.</p>

        <?php if (isset($message)) : ?>
            <p class="form-message"><?php echo $message; ?></p>
        <?php endif; ?>

        <form action="#" method="post" class="auth-form">
            <label for="name">Nome <span>*</span></label>
            <input type="text" name="name" id="name" placeholder="Ana Souza" required>

            <label for="email">E-mail <span>*</span></label>
            <input type="email" name="email" id="email" placeholder="ana@email.com" required>

            <label for="password">Senha <span>*</span></label>
            <input type="password" name="password" id="password" placeholder="Crie uma senha" required>

            <button type="submit" class="auth-submit">Criar conta</button>
        </form>

        <p class="auth-footer">Já tem uma conta? <a href="login.php">Entrar</a></p>
    </main>
</body>
</html>