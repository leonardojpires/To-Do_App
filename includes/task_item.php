<tbody>
    <div class='task'>
        <!-- Task: Checkbox (task completed), Name, Edit Name  -->
        <tr>
            <td>

                <!-- In the original "index.php" code, the ID attribute was unique for each task, since it was being generated dynamically throigh a while loop. However, when the task item is moved to a separate template ("task_item.php") -->
                <span
                    for="task-name-<?= $row['id'] ?>"
                    class="<?= $task_class ?>"
                    data-task-name='<?= $row['id'] ?>'>
                    <?= htmlspecialchars($task_name)?>
                </span>
                <input
                    type='text'
                    class="edit_input"
                    id='task_edit-<?= $row['id'] ?>'
                    value="<?= htmlspecialchars($task_name)?>"
                    style='display: none'>

            </td>

            <td>

                <small> <?= $created_at ?> </small>

            </td>
            <td>

                <div class="is_completed_input">
                    <input
                        type='checkbox'
                        class="task_class"
                        id="task-name-<?= $row['id'] ?>"
                        data-task-id='<?= $row['id'] ?>'
                        onclick='completeTask(<?= $row['id'] ?>)'
                    <?= $checked ?>>
                    <label class="task_name_class" for="task-name-<?= $row['id'] ?>"></label>
                </div>

            </td>

            <!-- Buttons: Delete, Edit and Save Edit -->
            <td class="actions">
                <form action='delete.php' method='POST'>
                    <input
                        type='hidden'
                        name='task_id'
                        value='<?= $row['id'] ?>'>
                    <button
                        class='del_button'
                        name='delete'
                        type='submit'>
                        &#10060; <!-- Delete button -->
                    </button>
                </form>

                    <button
                        class='edit_button'
                        data-task-id='<?= $row['id'] ?>'
                        name='delete'
                        onclick='enableEdit(<?= $row['id'] ?>)'>
                        &#x270F;&#xFE0F; <!-- Edit button -->
                    </button>
                    <button
                        class='save_button'
                        data-task-id='<?= $row['id'] ?>'
                        name='delete' style='display: none'
                        onclick='saveEdit(<?= $row['id'] ?>)'>
                        &#128190; <!-- Save Button -->
                    </button>

            </td>
        </tr>
    </div>
</tbody>