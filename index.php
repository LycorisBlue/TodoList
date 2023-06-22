<?php
// index.php

require_once 'config.php';
require_once 'task.php';

$taskObj = new Task($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si le formulaire de création est soumis, créer une nouvelle tâche
    if (isset($_POST['create'])) {
        $task = $_POST['task'];
        $taskObj->createTask($task);
    }
    // Si le formulaire de mise à jour est soumis, mettre à jour la tâche spécifique
    elseif (isset($_POST['update'])) {
        $taskId = $_POST['taskId'];
        $task = $_POST['task'];
        $taskObj->updateTask($taskId, $task);
    }
    header("Location: index.php");
    exit();
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $taskId = $_GET['id'];
    // Si l'action est "complete", marquer la tâche comme terminée
    if ($action === 'complete') {
        $taskObj->completeTask($taskId);
    }
    // Si l'action est "delete", supprimer la tâche
    elseif ($action === 'delete') {
        $taskObj->deleteTask($taskId);
    }
    header("Location: index.php");
    exit();
}

// Récupérer toutes les tâches
$tasks = $taskObj->getTasks();
?>

<!DOCTYPE html>
<html>
<head>
    <title>TodoList</title>
</head>
<body>
    <h1>TodoList</h1>

    <h2>Ajouter une tâche :</h2>
    <form method="post" action="">
        <input type="text" name="task" placeholder="Nouvelle tâche" required>
        <button type="submit" name="create">Ajouter</button>
    </form>

    <h2>Liste des tâches :</h2>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <?php echo $task['task']; ?>
                <?php if ($task['completed'] == 0): ?>
                    <a href="index.php?action=complete&id=<?php echo $task['id']; ?>">Terminée</a>
                <?php endif; ?>
                <a href="edit.php?id=<?php echo $task['id']; ?>">Modifier</a>
                <a href="index.php?action=delete&id=<?php echo $task['id']; ?>">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
