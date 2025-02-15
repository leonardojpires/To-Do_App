<?php

include 'includes/db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_name = $_POST["task_name"];
    $task_class = isset($_POST["task_class"]) ? 1 : 0;

    if (!empty($task_name)) {
        $sql = "INSERT INTO tasks (task_name, is_completed) VALUES (?, ?)";
        $stmt = $conn->prepare(query: $sql);
        $stmt->bind_param("ss", $task_name, $task_class);
        $stmt->execute();
        $stmt->close();
        
        header(header: "Location: index.php");
        exit();
    }
}