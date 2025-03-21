<div class='task'>

    <!-- Task: Checkbox (task completed), Name, Edit Name  -->

    <input 
        type='checkbox'
        id="task-name-<?= $row['id'] ?>"
        data-task-id='<?= $row['id'] ?>' 
        onclick='completeTask(<?= $row['id'] ?>)' 
        <?= $checked ?>>
        <!-- In the original "index.php" code, the ID attribute was unique for each task, since it was being generated dynamically throigh a while loop. However, when the task item is moved to a separate template ("task_item.php") -->
    <label
        for="task-name-<?= $row['id'] ?>"
        class="<?= $task_class ?>" 
        data-task-name='<?= $row['id'] ?>'> 
        <?= htmlspecialchars($task_name)?>
    </label>

    <input 
        type='text' 
        id='task_edit-<?= $row['id'] ?>' 
        value="<?= htmlspecialchars($task_name)?>" 
        style='display: none'>
    
    <small> <?= $created_at ?> </small>

    <!-- Buttons: Delete, Edit and Save Edit -->

    <div>
        <form action='delete.php' method='POST'>
            <input 
                type='hidden' 
                name='task_id' 
                value='<?= $row['id'] ?>'>

            <button 
                class='del_button' 
                name='delete' 
                type='submit'>
                ❌
            </button>
        </form>

            <button 
                class='edit_button' 
                data-task-id='<?= $row['id'] ?>' 
                name='delete' 
                onclick='enableEdit(<?= $row['id'] ?>)'>
                ✏️
            </button>
            <button 
                class='save_button' 
                data-task-id='<?= $row['id'] ?>' 
                name='delete' style='display: none' 
                onclick='saveEdit(<?= $row['id'] ?>)'>
                Save
            </button>
    </div>
</div>