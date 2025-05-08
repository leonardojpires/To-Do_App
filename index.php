<?php 

include 'includes/db.php'; // Include database connection

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toolist</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/edit_task_name.js"></script>
    <script src="js/mark_task.js"></script>
</head>
<body>
    <header class="container">
        <h1>Toolist</h1>
        <p>This project was created using: <strong>JavaScript</strong>, <strong>PHP</strong> and <strong>MySQL</strong> </p>
    </header>

    <main class="container">
        <section class="add_task">
            <h2>Insert your tasks</h2>
            <form id="task_form">
                <label for="task_name">Task name</label>
                <input type="text" name="task_name" id="itask_name" placeholder="Insert your task name" required>
                <div class="is_completed_input">
                    <input type="checkbox" name="task_class" class="task_class" id="itask_class" value="1">
                    <label class="task_class_label" for="itask_class">Is the task already completed?</label>
                </div>
                <input type="submit" value="&#43;">
            </form>
            <hr>
        </section>
        <hr>
        <section class="tasks">
        <h2>Tasks:</h2>
        <?php 
        $result = $conn->query(query: "SELECT * FROM tasks ORDER BY created_at DESC");
        if ($result->num_rows > 0): ?>
            <table>
                <tbody>
                    <?php 
                        include 'includes/tasks.php';
                    ?>
                </tbody>
            </table>
        <?php else: ?>
            <table>
                <tbody>
                    <tr id="no-tasks-row">
                        <td>No tasks found</td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
        </section>
    </main>
</body>
</html>