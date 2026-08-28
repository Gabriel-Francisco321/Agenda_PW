<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Agenda_PW/auth/login.php');
    exit();
}

include 'C:\xampp\htdocs\Agenda_PW\classes\Usuario.php';
include 'C:\xampp\htdocs\Agenda_PW\classes\Apontamento.php';

$current_user = Usuario::find($_SESSION['user_id']);

$apontamentos = Apontamento::findByUserId($current_user->getId());

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header class="header">
        <div class="container">
            <a href="index.php" class="logo">
                <h3>Agenda</h3>
            </a>

            <span class="user-info">
                <span class="user-name"><?php echo $current_user->getNome(); ?></span>
                <a href="auth/logout.php" class="logout-link">Sair</a>
            </span>
        </div>
    </header>

    <main class="main">
        <div class="left">
            <h2 class="section-title">PRÓXIMA TAREFA</h2>
            <div class="next-task">
                <?php if (!empty($apontamentos)) : ?>
                    <?php $next_task = $apontamentos[0]; ?>
                    <div class="task-top">
                        <span class="status-badge status-<?php echo strtolower($next_task->getEstado()); ?>"><?php echo $next_task->getEstado(); ?></span>
                        <span class="task-title"><?php echo $next_task->getTitulo(); ?></span>
                        <span class="task-description"><?php echo $next_task->getDescricao(); ?></span>
                    </div>

                    <div class="time">
                        <div>
                            <span class="task-date"><?php echo $next_task->getData(); ?></span>
                            <span class="task-time"><?php echo $next_task->getInicio(); ?></span>
                        </div>
                        <form action="dashboard/concluir.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $next_task->getId(); ?>">
                            <button class="finish-button" type="submit">Marcar como concluída</button>
                        </form>
                    </div>

                <?php else : ?>

                    <p>Nenhuma tarefa encontrada.</p>

                <?php endif; ?>

            </div>
            <div class="total">
                <p>Total <?php echo count($apontamentos); ?></p>
            </div>
        </div>

        <div class="right">
            <form class="search" method="get" action="index.php">
                <input type="text" name="search" id="search" placeholder="Pesquisar">
                <button type="submit">Buscar</button>
                <button id="addTask" type="button">Nova Tarefa</button>
            </form>
            <div class="tasks">
                <table>
                    <thead>
                        <tr>
                            <th class="section-title">Tarefa</th>
                            <th class="section-title">Data / Hora</th>
                            <th class="section-title">Estado</th>
                            <th class="section-title actions-heading">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($apontamentos as $apontamento) : ?>
                            <tr class="task-row <?php echo $apontamento === $next_task ? 'is-next' : ''; ?>">
                                <td class="task-info task-details">
                                    <strong><?php echo $apontamento->getTitulo(); ?></strong>
                                    <span class="task-description"><?php echo $apontamento->getDescricao(); ?></span>
                                </td>
                                <td class="task-info task-date-time">
                                    <span><?php echo $apontamento->getData(); ?></span>
                                    <span><?php echo "{$apontamento->getInicio()} - {$apontamento->getFim()}"; ?></span>
                                </td>
                                <td><span class="status-badge status-<?php echo strtolower($apontamento->getEstado()); ?>"><?php echo $apontamento->getEstado(); ?></span></td>
                                <td class="task-actions">
                                    <button
                                        type="button"
                                        class="edit-task-button"
                                        data-id="<?php echo $apontamento->getId(); ?>"
                                    >Editar</button>
                                    <a href="dashboard/excluir.php?id=<?php echo $apontamento->getId(); ?>">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="modal-overlay" id="taskModal" aria-hidden="true">
        <section class="task-modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
            <div class="modal-header">
                <div>
                    <h2 id="modalTitle">Nova tarefa</h2>
                    <p>Preencha os campos abaixo para adicionar uma tarefa.</p>
                </div>
                <button class="close-modal" id="closeModal" type="button" aria-label="Fechar"></button>
            </div>

            <form action="dashboard/adicionar.php" method="post" class="task-form">
                <label for="titulo">Título <span>*</span></label>
                <input type="text" name="titulo" id="titulo" placeholder="Ex.: Reunião com stakeholders" required>

                <label for="descricao">Descrição</label>
                <textarea name="descricao" id="descricao" placeholder="Adicione detalhes sobre a tarefa..." required></textarea>

                <div>
                    <label for="data">Data <span>*</span></label>
                    <input type="date" name="data" id="data" required>
                </div>

                <div class="form-row">
                    <div>
                        <label for="inicio">Inicio <span>*</span></label>
                        <input type="time" name="inicio" id="inicio" required>
                    </div>

                    <div>
                        <label for="fim">Fim <span>*</span></label>
                        <input type="time" name="fim" id="fim" required>
                    </div>
                </div>

                <div class="modal-actions">
                    <button class="cancel-button" id="cancelModal" type="button">Cancelar</button>
                    <button class="create-button" type="submit">Criar tarefa</button>
                </div>
            </form>
        </section>
    </div>

    <script src="js/scripts.js"></script>

</body>

</html>