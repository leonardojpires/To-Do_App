<?php 

include 'includes/db.php'; // Include database connection

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do App</title>
    <style>
        .completed {
            text-decoration: line-through;
            color:rgba(0, 0, 0, 0.77);
        }
    </style>
    <script src="js/edit_task_name.js"></script>
    <script src="js/mark_task.js"></script>
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos explicabo quisquam in atque nulla unde recusandae, odio eligendi laborum nostrum, aut cum! Voluptate dolorem inventore impedit nulla? Sunt, veritatis in.</p>
        <hr>
        <h2>Insert your tasks</h2>
        <form method="POST" action="add.php">
            <label for="task_name">Task name</label> <br>
            <input type="text" name="task_name" id="itask_name" placeholder="Insert your task name" required>
            <br>
            <br>
            <label for="task_class">Is Completed?</label>
            <input type="checkbox" name="task_class" id="itask_class" value="1">
            <input type="submit" value="Add task">
        </form>
        <hr>
        <h2>Tasks:</h2>
        <div class="tasks">
            
            <?php 
                $result = $conn->query(query: "SELECT * FROM tasks ORDER BY created_at DESC");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $task_name = htmlspecialchars($row["task_name"]);
                        $task_class = $row["is_completed"] ? "completed" : "";
                        $created_at = date("d M, Y H:i", strtotime($row["created_at"])) ;
                        $checked = $row["is_completed"] ? "checked" : "";
                        
                            echo "
                                <div class='task'>
                                    <input type='checkbox' id='task_completed-" . $row['id'] . "' onclick='completeTask(" . $row['id'] . ")' $checked>
                                    <span class='$task_class' id='task_name-" . $row['id'] . "'>$task_name</span>
                                    <input type='text' id='task_edit-" . $row['id'] . "' value=\"" . htmlspecialchars($task_name) . "\"  style='display: none'>
                                    
                                    <small>$created_at</small>

                                    <div>
                                        <form action='delete.php' method='POST'>
                                            <input type='hidden' name='task_id' value='" . $row['id'] . "'>
                                            <button class='del_button' name='delete' type='submit'>❌</button>
                                        </form>
                                        <button class='del_button' id='task-" . $row['id'] . "-button' name='delete' onclick='enableEdit(" . $row['id'] . ")'>✏️</button>
                                        <button id='task-" . $row['id'] . "-button' name='delete' onclick='saveEdit(" . $row['id'] . ")' style='display: none'>Save</button>
                                    </div>
                                </div>
                            ";
                        }
                }       
                else {
                    echo "No tasks found";
                }
            ?>
        </div>
    </div>
</body>
</html>