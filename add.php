<?php

include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_name = $_POST["task_name"];

    // Handle the 'task_class' checkbox: If the checkbox is checked, its value is 1 (true). If unchecked, it will not be in the '$_POST' array, so it's default to  0 (false)
    $is_completed = isset($_POST["task_class"]) ? 1 : 0; // - Without the ternary operator, it would still work, but using it avoids convertions problems

/*     // Ensure the task name is not empty before inserting it into the database
    if (!empty($task_name)) {

        // Prepare an SQL statement to insert the task into the database
        $sql = "INSERT INTO tasks (task_name, is_completed) VALUES (?, ?)";

        // Prepare the SQL query to prevent SQL injection, execute it and then close it
        $stmt = $conn->prepare(query: $sql);
        $stmt->bind_param("si", $task_name, $task_class); // - task_name is a STRING, 'task_class' is an INTEGER
        $stmt->execute();
        $stmt->close();
        
        

        // Redirect the user to the main page (index.php)
        // header(header: "Location: index.php");

        // Exit the script to ensure no further code is executed
        exit();
    } */

    $sql = "INSERT INTO tasks (task_name, is_completed) VALUES (?, ?)";

    $stmt->$conn->prepare($sql);
    $stmt->bind_param("si", $task_name, $is_completed);
    $stmt->execute();

    $task_id = $stmt->insert_id;

    $response = [
        "id" => $task_id,
        "task_name" => htmlspecialchars($task_name),
        "is_completed" => $is_completed,
        "created_at" => date("d/m/Y"),
    ];

    echo json_encode($response);
    exit;
}