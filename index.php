<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Cursophp/pprojects/Agenda_PW/auth/login.php');
    exit();
}



?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
</head>

<body>

    <table border="1">
        <thead>
            <tr>
                <th>titulo</th>
                <th>descrição</th>
                <th>data</th>
                <th>estado</th>
            </tr>
        </thead>
        <tbody>
            <?php

            include 'C:\xampp\htdocs\Cursophp\pprojects\Agenda_PW\classes\Apontamento.php';
            $apontamento = new Apontamento();
            $apontamentos = $apontamento->findByUserId($_SESSION['user_id']);
            foreach ($apontamentos as $apontamento) {
                echo "
                    <tr>
                        <td>{$apontamento['titulo']}</td>
                        <td>{$apontamento['descricao']}</td>
                        <td>{$apontamento['data']}</td>
                        <td>{$apontamento['estado']}</td>
                        <td><a href='dashboard/alterar.php?id={$apontamento['id']}'>alterar</a></td>
                        <td><a href='dashboard/excluir.php?id={$apontamento['id']}'>excluir</a></td>
                    </tr>
                    ";
            }

            ?>
        </tbody>
    </table>

    <p><a href="dashboard/adicionar.php">adicionar apontamento</a> || <a href="auth/logout.php">sair</a></p>

</body>

</html>