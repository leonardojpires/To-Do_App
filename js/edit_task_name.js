function enableEdit(taskId) {
    // Hide the task name and show the input field
    document.getElementById("task_name-" + taskId).style.display = "none";
    document.getElementById("task_edit-" + taskId).style.display = "inline-block";

    // Show the Save button and hide the Edit button
    let buttons = document.querySelectorAll("#task-" + taskId + "-button" );
    buttons[0].style.display = "none";
    buttons[1].style.display = "inline-block";
}

function saveEdit(taskId) {
    let newName = document.getElementById("task_edit-" + taskId).value;
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "update.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById("task_name-" + taskId).textContent = newName;
            document.getElementById("task_name-" + taskId).style.display = "inline-block";
            document.getElementById("task_edit-" + taskId).style.display = "none";

            let buttons = document.querySelectorAll("#task-" + taskId + "-button" );
            buttons[0].style.display = "inline-block";
            buttons[1].style.display = "none";
        }
        else {
            alert("Error updating task.");
        }
    }
    xhr.send("id=" + taskId + "&task_name=" + encodeURIComponent(newName));
}