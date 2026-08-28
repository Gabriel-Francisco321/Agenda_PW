const taskModal = document.getElementById('taskModal');
const addTask = document.getElementById('addTask');
const closeModal = document.getElementById('closeModal');
const cancelModal = document.getElementById('cancelModal');
const taskForm = document.querySelector('.task-form');
const modalTitle = document.getElementById('modalTitle');
const modalDescription = document.querySelector('.modal-header p');
const submitButton = taskForm.querySelector('button[type="submit"]');
const editTaskButtons = document.querySelectorAll('.edit-task-button');
const searchInput = document.getElementById('search');
const searchButton = document.querySelector('.search button[type="submit"]');

function resetTaskForm() {
    taskForm.reset();
    taskForm.action = 'dashboard/adicionar.php';
    modalTitle.textContent = 'Nova tarefa';
    modalDescription.textContent = 'Preencha os campos abaixo para adicionar uma tarefa.';
    submitButton.textContent = 'Criar tarefa';
}

function openEditModal(button) {
    const row = button.closest('.task-row');
    const details = row.querySelector('.task-details');
    const schedule = row.querySelector('.task-date-time');
    const scheduleValues = schedule.querySelectorAll('span');
    const task = {
        id: button.dataset.id,
        titulo: details.querySelector('strong').textContent.trim(),
        descricao: details.querySelector('.task-description').textContent.trim(),
        data: scheduleValues[0].textContent.trim(),
        inicio: scheduleValues[1].textContent.trim().split(' - ')[0],
        fim: scheduleValues[1].textContent.trim().split(' - ')[1]
    };

    taskForm.action = `dashboard/alterar.php?id=${encodeURIComponent(task.id)}`;
    document.getElementById('titulo').value = task.titulo;
    document.getElementById('descricao').value = task.descricao;
    document.getElementById('data').value = task.data;
    document.getElementById('inicio').value = task.inicio;
    document.getElementById('fim').value = task.fim;
    modalTitle.textContent = 'Editar tarefa';
    modalDescription.textContent = 'Atualize os campos da tarefa abaixo.';
    submitButton.textContent = 'Salvar alterações';
    toggleTaskModal(true);
}

function toggleTaskModal(show) {
    taskModal.classList.toggle('is-open', show);
    taskModal.setAttribute('aria-hidden', String(!show));
    document.body.classList.toggle('modal-open', show);
    if (show) document.getElementById('titulo').focus();
}

addTask.addEventListener('click', () => {
    resetTaskForm();
    toggleTaskModal(true);
});
closeModal.addEventListener('click', () => {
    resetTaskForm();
    toggleTaskModal(false);
});
cancelModal.addEventListener('click', () => {
    resetTaskForm();
    toggleTaskModal(false);
});
editTaskButtons.forEach((button) => button.addEventListener('click', () => openEditModal(button)));
searchInput.addEventListener('input', () => {
    const searchTerm = searchInput.value.trim().toLowerCase();

    document.querySelectorAll('.task-row').forEach((row) => {
        const title = row.querySelector('.task-details strong').textContent.toLowerCase();
        row.hidden = !title.includes(searchTerm);
    });
});
searchButton.addEventListener('click', (event) => event.preventDefault());
taskModal.addEventListener('click', (event) => {
    if (event.target === taskModal) {
        resetTaskForm();
        toggleTaskModal(false);
    }
});
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && taskModal.classList.contains('is-open')) {
        resetTaskForm();
        toggleTaskModal(false);
    }
});