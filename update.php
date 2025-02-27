<?php 

include 'includes/db.php';

if (isset($_POST["id"]) && isset($_POST["task_name"])) {
    $id = $_POST["id"];
    $new_task_name = trim($_POST["task_name"]);

    if (!empty($new_task_name)) {
        $query = "UPDATE tasks SET task_name = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $new_task_name,$id);
        $stmt->execute();
        $stmt->close();
    }
}

?>