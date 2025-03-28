<?php

include 'db.php';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $task_name = htmlspecialchars($row["task_name"]);
        $task_class = $row["is_completed"] ? "completed" : "";
        $created_at = date("d/m/Y", strtotime($row["created_at"])) ;
        $checked = $row["is_completed"] ? "checked" : "";
        
        include 'task_item.php';

        }
    
}     
?>