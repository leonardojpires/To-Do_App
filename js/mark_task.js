function completeTask(taskId) {
    // console.log("Checkbox clicado! Task ID: " + taskId);
    let checkbox = document.querySelector("[data-task-id='" + taskId + "']").checked;
    let taskName = document.querySelector("[data-task-name='" + taskId + "']");

    fetch("task_completed.php?task_id=" + taskId, {
        method: "GET"
    }).then(response => {
        if (!response.ok) {
            throw new Error("Error completting task.");
        }
        return response.text();
    }).then(() => {
        if (checkbox) {
            taskName.classList.add("completed");
        }
        else {
            taskName.classList.remove("completed");

        }
    }).catch(error => alert("Error: " + error));
}