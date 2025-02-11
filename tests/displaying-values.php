<?php

include '../includes/db.php'; // Include database connection

# Display rows

// SQL query to fetch all tasks from the 'tasks' table
 $sql_query = "SELECT id, task_name, is_completed, created_at FROM tasks";

 // Execute the query and store the result in $result
 $result = $conn->query(query: $sql_query); // $result now contains the result of the query

 // Check if the query retured any rows (if there are tasks in the table)
 if ($result->num_rows > 0) {
    // If there are tasks, it will loop through each task and display it

    // Loop through each row in the result set
     while ($row = $result->fetch_assoc()) {
        // For each task, display the ID, task name, completion status, and creation time

        // Display the task information
         echo "ID: " . $row["id"] . " - Task: " . $row["task_name"] . " - Completed: " . ($row["is_completed"] ? "Yes" : "No") . " - Created At: " . $row["created_at"] . "<br>";

         /* fetch_assoc() is a method that retrieves the next row from the result as an associative array. Each row is stored as an array where the keys are the column names, and the values are the data from that row
         In this case, the values are stored in the $row array */
     }
 } else {
     echo "No tasks found.";
 }
 
 $conn->close();