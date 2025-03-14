<?php 

include 'includes/db.php';

if (isset($_GET["task_id"])) {
    $id = $_GET["task_id"];
    
    /* STEP 1. Retrieve the current completion status of the task
        * It checks if the task is currently marked as completed (1) or not (0
        * Based on this value, it will toggle it
    */

    // Create a MySQL query to fetch the 'is_completed' status of the given ID
    $query = "SELECT is_completed FROM tasks WHERE id = ?";

    // Prepare the SQL query to prevent SQL injection, execute it and then close it
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Retrieve the result of the query and fetch the row as an associative array
    // These are only used when we are selecting data from the database using a 'SELECT' query
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();

    // Closes the statement after fetching the data
    $stmt->close();

    /* STEP 2: Toggle the 'is_completed' status 
        * If the task exists, it changes its status
        * If 'is_completed' is 1 (completed), set it to 0 (not completed)   
        * If 'is_completed' is 0 (not completed), set it to 1 (completed)
    */

    // Ensure the tasks exists before updating it
    if ($task) {
        // Toggle the 'is_completed' value: If it's 1, set to 0; If it's 0, set to 1
        $new_status = $task["is_completed"] ? 0 : 1; // $task is an array due to the fetch_assoc() function

        // Create an UPDATE SQL query to change the 'is_completed' value
        $update_query = "UPDATE tasks SET is_completed = ? WHERE id = ?";

        // Prepare the SQL query to prevent SQL injection, execute it and then close it
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ii", $new_status, $id);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect the user to the main page (index.php)
    header(header: "Location: index.php");

    // Exit the script to ensure no further code is executed
    exit();
}
?>