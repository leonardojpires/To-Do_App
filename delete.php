<?php 

include 'includes/db.php'; // Include database connection

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

echo "<pre>";
    print_r($_POST);
echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete"])) {
        $id = $_POST["task_id"];
        $sql = "DELETE FROM tasks WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        header(header: "Location: index.php");
        exit();
    }
}