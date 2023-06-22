<?php
// edit.php

require_once 'config.php';
require_once 'task.php';

$taskId = $_GET['id'];

$taskObj = new Task($conn);
$task = $taskObj->getTask($taskId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newTask = $_POST['task'];
    $taskObj->updateTask($taskId, $newTask);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier une tâche</title>
</head>
<body>
    <h1>Modifier une tâche</h1>

    <form method="post" action="">
        <input type="text" name="task" value="<?php echo $task['task']; ?>" required>
        <input type="hidden" name="taskId" value="<?php echo $taskId; ?>">
        <button type="submit" name="update">Modifier</button>
    </form>
</body>
</html>
