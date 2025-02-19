<?php 

include 'includes/db.php';


# - TESTING - #

        /* echo "<pre>";
            print_r($_POST);
        echo "</pre>";

        $task_id = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id'])) {
            $task_id = $_POST['task_id'];
        }
            echo $task_id;
        ?> */

# - END OF TESTING - #


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete"])) {
        $id = $_POST["task_id"];

        // This is a SQL DELETE statement, which removes a task from the database where 'id' matches the given value. The '?' is a placeholder for the actual value. This ensures protection against SQL injection
        $sql = "DELETE FROM tasks WHERE id = ?";

        // The prepare() function tells the database to get ready for execution. The database checks the SQL syntax but doesn't execute it yet. This serves as a safe execution plan for later when it comes to insert real values
        $stmt = $conn->prepare($sql);

        // The bind_param attaches real values to the placeholders (?). It ensures the value is the correct data type (in this case, a string -> "i"), so it guarantees that $id is treated as a number rather than a part of the SQL syntax
        $stmt->bind_param("i", $id);

        // This executes the SQL query with the actual value
        $stmt->execute();

        // Once it's done, the prepared statement is closed (free up memory, prevent potential bugs, keep the database connection efficient)
        $stmt->close();

        
        // Redirect the user to the main page (index.php)
        header(header: "Location: index.php");

        // Exit the script to ensure no further code is executed
        exit();
    }
}