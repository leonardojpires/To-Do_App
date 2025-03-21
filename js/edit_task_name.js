function enableEdit(taskId) {
    // Hide the task name and show the input field
    document.querySelector("[data-task-name='" + taskId + "']").style.display = "none";
    document.getElementById("task_edit-" + taskId).style.display = "inline-block";

    // Show the Save button and hide the Edit button
    let editButton = document.querySelector(".edit_button[data-task-id='" + taskId + "']");
    let saveButton = document.querySelector(".save_button[data-task-id='" + taskId + "']");

    editButton.style.display = "none";
    saveButton.style.display = "inline-block";
}

// --------------- AJAX BELOW --------------- // 

// -- OLD METHOD -- //

/* Function to save the edited task name

    - Retrieves the new task name entered by the user
    - Sends an AJAX request to update de task name on the server
    - Updates the task name on the webpage without reloading it

*/

/* function saveEdit(taskId) {
    // Get the new task name from the input field
    let newName = document.getElementById("task_edit-" + taskId).value;
    
    // Create a new XMLHttpRequest request object to handle the AJAX request
    // A XMLHttpRequest request is a built-in JavaScript object that allows web pages to make HTTP requests to a server without reloading the page //
    let xhr = new XMLHttpRequest();

    // Configure the AJAX request

        - Method: POST
        - URL: update.php
        - the 'true' parameter is to make the request asynchronous (Async)

    //
    xhr.open("POST", "update.php", true);

    // Set the appropriate request header
    
        - This informs the server that the data is being sent in an "application/x-www-form-urlencoded" formatm which is similar to data sent in HTML form submission
    
    //
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Define what happens when the server responds
    
        - If the request is successful (status 200), update the webpage dynamically
        - If unsuccessful, show an error message
    
    //
    xhr.onload = function() {
        if (xhr.status === 200) { // Check if the request was successful

            // Update the task name on the webpage
            document.getElementById("task_name-" + taskId).textContent = newName;
            
            // Ensure the task name is visible (in case it was hidden during editing)
            document.getElementById("task_name-" + taskId).style.display = "inline-block";

            // Hide the editing input field since the name has been updated
            document.getElementById("task_edit-" + taskId).style.display = "none";

            // Update the visibility of buttons related to the task
            let buttons = document.querySelectorAll("#task-" + taskId + "-button" );
            buttons[0].style.display = "inline-block";
            buttons[1].style.display = "none";
        }
        else {
            // If the request fails, show an error message to the user
            alert("Error updating task.");
        }
    }

    // Send the AJAX request with data
    
        - The data is formatted as a query string (key-value pairs)
        - encodeURIComponent() ensures special characters (like spaces) are properly encoded

    //
    xhr.send("id=" + taskId + "&task_name=" + encodeURIComponent(newName));
} */



    // -- NEW METHOD (fetch()) -- //

/* Function to save the edited task name

    - Retrieves the new task name entered by the user
    - Sends an AJAX request to update de task name on the server
    - Updates the task name on the webpage without reloading it

*/
function saveEdit(taskId) {
    // Get the new task name from the input field
    let newName = document.getElementById("task_edit-" + taskId).value;
    let name = document.querySelector("[data-task-name='" + taskId + "']");
    let edit = document.getElementById("task_edit-" + taskId);

    /* Send an asynchronous HTTP request to update the task name on the server
    
        - URL: "updatephp" (server-side script that handles the updates)
        - Method: "POST" (since we are sending data to the server)
        - Headers: Specifies that we are sending form-enconded data
        - Body: The task ID and new task name, properly encoded to prevent issues with the special characters

    */
    fetch("update.php", {
        method: "POST",
        headers: {
            "Content-type": "application/x-www-form-urlencoded"
        },
        body: "id=" + taskId + "&task_name=" + encodeURIComponent(newName)
    })
    .then(response => {

        /* Handle the server response
        
            - If the response is not OK (e.g. server error), throw an error
            - Otherwise, continue processing

        */

        if (!response.ok) {
            throw new Error("Failed to update task."); // If there's an error, stops execution
        }   
        return response.text(); // Read the response as plain text (or JSON if needed)
    })
    .then(() => {
        // Update the task name on the webpage
        name.textContent = newName;

        // Ensure the task name is visible (in case it was hidden during editing)
        name.style.display = "inline-block";

        // Hide the editing input field since the name has been updated
        edit.style.display = "none";

        // Update the visibility of buttons related to the task
        let editButton = document.querySelector(".edit_button[data-task-id='" + taskId + "']");
        let saveButton = document.querySelector(".save_button[data-task-id='" + taskId + "']");
    
        editButton.style.display = "inline-block";
        saveButton.style.display = "none";
    })
    .catch(error => {

        /* Handle any errors that occur during the fetch request
        
            - If something goes wrong (e.g. server is down), show an alert to the user

        */
        alert(error.message); // Display the error message
    })
}

/* -- IMPORTANT NOTE --

    I could have opted for an async/await solution using try/catch. This solution would have made the code even cleaner, but I stuck with the fetch option for a sake of learning

*/