<?php
// task.php

class Task {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Méthode pour créer une nouvelle tâche
    public function createTask($task) {
        $query = "INSERT INTO tasks (task, completed) VALUES (?, 0)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $task);
        $stmt->execute();
        $stmt->close();
    }

    // Méthode pour récupérer toutes les tâches
    public function getTasks() {
        $query = "SELECT * FROM tasks";
        $result = $this->conn->query($query);
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        return $tasks;
    }

    // Méthode pour récupérer une tâche spécifique par ID
    public function getTask($taskId) {
        $query = "SELECT * FROM tasks WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $taskId);
        $stmt->execute();
        $result = $stmt->get_result();
        $task = $result->fetch_assoc();
        $stmt->close();
        return $task;
    }

    // Méthode pour mettre à jour une tâche
    public function updateTask($taskId, $task) {
        $query = "UPDATE tasks SET task = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $task, $taskId);
        $stmt->execute();
        $stmt->close();
    }

    // Méthode pour marquer une tâche comme terminée
    public function completeTask($taskId) {
        $query = "UPDATE tasks SET completed = 1 WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $taskId);
        $stmt->execute();
        $stmt->close();
    }

    // Méthode pour supprimer une tâche
    public function deleteTask($taskId) {
        $query = "DELETE FROM tasks WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $taskId);
        $stmt->execute();
        $stmt->close();
    }
}
