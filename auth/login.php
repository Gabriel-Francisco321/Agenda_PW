<?php

if ($_SESSION['user_id']) {
    header('Location: http://localhost/Agenda_PW/index.php');
}

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if ($email && $password) {
    include 'C:\xampp\htdocs\Agenda_PW\classes\Usuario.php';
    $user = Usuario::findByEmail($email);
    if ($user && $user->getSenha() === $password) {
        session_start();
        $_SESSION['user_id'] = $user->getId();
        header('Location: http://localhost/Agenda_PW/index.php');
    } else {
        $message = "email ou senha incorreta";
    }
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="auth-page">
    <main class="auth-card">
        <a href="../index.php" class="auth-brand">
            <strong>Agenda</strong>
        </a>

        <h1>Bem-vindo de volta</h1>
        <p class="auth-subtitle">Entre na sua conta para continuar.</p>
        
        <?php if (isset($message)) : ?>
            <p class="form-message"><?php echo $message; ?></p>
        <?php endif; ?>

        <form action="#" method="post" class="auth-form">
            <label for="email">E-mail <span>*</span></label>
            <input type="email" name="email" id="email" placeholder="ana@email.com" required>

            <div class="password-label">
                <label for="password">Senha <span>*</span></label>
            </div>
            <input type="password" name="password" id="password" placeholder="Sua senha" required>

            <button type="submit" class="auth-submit">Entrar</button>
        </form>

        <p class="auth-footer">Não tem uma conta? <a href="cadastro.php">Criar conta</a></p>
    </main>

    <script>
        <?php if (!empty($message)) : ?>
            alert("<?php echo $message; ?>");
        <?php endif; ?>
    </script>

</body>

</html>