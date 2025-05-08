document.getElementById("task_form").addEventListener("submit", (e) => {
    e.preventDefault();

    const formData = new FormData(this);
    const noTasksRow = document.getElementById("no-tasks-row");

    fetch("add.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (noTasksRow) {
            noTasksRow.remove();
        }

        const table = document.querySelector(".tasks table");
        if (!table.querySelector("thead")) {
            const thead = document.createElement("thead");
            thead.innerHTML = `
                <thead>
                    <th>Task</th>
                    <th>Created at</th>
                    <th>Is completed?</th>
                    <th>Actions</th>
                </thead>
            `;
            table.insertBefore(thead, table.firstChild);

            const newRow = `
                            <tr>
                                <td>
                                    <span class="${data.isCompleted ? 'completed' : ''}" data-task-name="${data.id}">${data.task_name}}></span>
                                </td>
                                <td>
                                    <small>${data.created_at}</small>
                                </td>
                                <td>
                                    <div class="is_completed_input">
                                        <input
                                            type="checkbox"
                                            class="task_class"
                                            id="task-name-${data.id}"
                                            data-task-id="${data.id}"
                                            onclick="completeTask(${data.id})"
                                            ${data.is_completed ? "checked" : ""}
                                            >
                                        <label class="task_name_class" for="task-name-${data.id}"></label>
                                    </div>
                                </td>
                                <td class="actions">
                                    <form action="../delete.php" method="POST">
                                        <input type="hiden" name="task_id" value="${data.id}">
                                        <button class="del_button" name="delete" type="submit">&#10060;</button>
                                    </form>
                                    
                                    <button
                                        class='edit_button'
                                        data-task-id='${data.id}'
                                        name='delete'
                                        onclick='enableEdit(<?= $row['id'] ?>)'>
                                        &#x270F;&#xFE0F;
                                    </button>
                                    <button
                                        class='save_button'
                                        data-task-id='${data.id}'
                                        name='delete' style='display: none'
                                        onclick='saveEdit(${data.id})'>
                                        &#128190;
                                </button>
                        </td>
                </tr>
            `
        }
    })
})