<?php

// Define database connection parameters
$host = 'localhost'; // The hostname or IP address of MySQL server
$user = 'root'; // The username to access the MySQL database
$password = ''; // The password associated with the MySQL username
$database = 'todo_app'; // The name of the database to connect to

// Create a new MySQLi (MySQL Improved) connection object using the parameters defined above
// MySQLi is a built-in PHP extension that allows interaction with MySQL databases. It provides a more secure and feature-rich interface compared to the older mysql extension. MySQLi is a class

$conn = new mysqli(
    hostname: $host, 
    username: $user, 
    password: $password, 
    database: $database
);

// Check if there was an error connecting to the database
if ($conn->connect_error) {

    // Log the connection error for troubleshooting
    error_log(message: 'Connection failed: '. $conn->connect_error);~

    // Terminate the script and display a user-friendly error message
    die('Something went wrong. Please try again later.');
}

?>