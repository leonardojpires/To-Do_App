<?php

 // Inserting values
 include '../includes/db.php'; // Include database connection

 // Generate a random number (0 or 1) for the 'is_completed' column
 $random = rand(min: 0, max: 1);

 // Define the SQL INSERT query
 $sql = "INSERT INTO tasks (task_name, is_completed) VALUES ('First task', $random)";

 // Execute the query using the MySQLi connection ($conn)
 if ($conn->query(query: $sql) === TRUE) {
    // If the query was sucessful, display a success message
     echo 'Task added successfully!';
 }
 else {
    // If there was as an error, display the error message from MySQL
     echo "Error: " . $conn->error;
 }