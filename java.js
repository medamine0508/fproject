document.addEventListener("DOMContentLoaded", () => {
    var taskForm = document.getElementById('task-form');
    var taskInput = document.getElementById('new-task');
    var taskList = document.getElementById('task-list');

    loadTasks();

    // Ajouter 
    taskForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const taskText = taskInput.value.trim();
        if (taskText !== "") {
            addTask(taskText);
            saveTask(taskText);
            taskInput.value = '';
        }
    });

    // Ajouter 2
    function addTask(taskText, completed = false) {
        const li = document.createElement('li');
        li.textContent = taskText;

        //  Supprimer
        const deleteBtn = document.createElement('button');
        deleteBtn.textContent = 'Supprimer';
        deleteBtn.addEventListener('click', () => {
            li.remove();
            removeTask(taskText);
        });

        // 
        li.addEventListener('click', () => {
            li.classList.toggle('completed');
            updateTaskStatus(taskText);
        });

        li.appendChild(deleteBtn);
        if (completed) li.classList.add('completed');
        taskList.appendChild(li);
    }

    // Enregistrer une tâche dans localStorage
    function saveTask(taskText) {
        let tasks = getTasksFromLocalStorage();
        tasks.push({ text: taskText, completed: false });
        localStorage.setItem('tasks', JSON.stringify(tasks));
    }

    // Charger les tâches depuis localStorage
    function loadTasks() {
        let tasks = getTasksFromLocalStorage();
        tasks.forEach(task => {
            addTask(task.text, task.completed);
        });
    }

    // Récupérer les tâches depuis localStorage
    function getTasksFromLocalStorage() {
        return localStorage.getItem('tasks') ? JSON.parse(localStorage.getItem('tasks')) : [];
    }

    // Mettre à jour le statut d'une tâche dans localStorage
    function updateTaskStatus(taskText) {
        let tasks = getTasksFromLocalStorage();
        tasks.forEach(task => {
            if (task.text === taskText) {
                task.completed = !task.completed;
            }
        });
        localStorage.setItem('tasks', JSON.stringify(tasks));
    }

    // Supprimer une tâche de localStorage
    function removeTask(taskText) {
        let tasks = getTasksFromLocalStorage();
        tasks = tasks.filter(task => task.text !== taskText);
        localStorage.setItem('tasks', JSON.stringify(tasks));
    }
});
