<?php 
include 'includes/db.php'; // Database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Toolist</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/edit_task_name.js"></script>
  <script src="js/mark_task.js"></script>
</head>
<body>
  <header class="bg-primary text-white py-4 mb-4">
    <div class="container">
      <h1 class="display-5">🛠️ Toolist</h1>
      <p class="lead">Built with <strong>JavaScript</strong>, <strong>PHP</strong>, and <strong>MySQL</strong></p>
    </div>
  </header>

  <main class="container">
    <section class="mb-5">
      <div class="card shadow-sm">
        <div class="card-header bg-light">
          <h2 class="h5 mb-0">Add a Task</h2>
        </div>
        <div class="card-body">
          <form method="POST" action="add.php" class="row g-3 align-items-center">
            <div class="col-md-6">
              <label for="itask_name" class="form-label">Task Name</label>
              <input type="text" name="task_name" id="itask_name" class="form-control" placeholder="Insert your task name" required>
            </div>
            <div class="col-md-4 d-flex align-items-center">
              <div class="form-check mt-4">
                <input type="checkbox" name="task_class" class="form-check-input" id="itask_class" value="1">
                <label class="form-check-label" for="itask_class">Already completed?</label>
              </div>
            </div>
            <div class="col-md-2 mt-4">
              <button type="submit" class="btn btn-success w-100">Add ➕</button>
            </div>
          </form>
        </div>
      </div>
    </section>

    <section>
      <h2 class="h4 mb-3">📋 Your Tasks</h2>

      <?php 
      $result = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC");
      if ($result->num_rows > 0): ?>
        <div class="table-responsive shadow-sm">
          <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
              <tr>
                <th scope="col">Task</th>
                <th scope="col">Created At</th>
                <th scope="col">Completed?</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php include 'includes/tasks.php'; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="alert alert-warning" role="alert">
          No tasks found. Add one above!
        </div>
      <?php endif; ?>
    </section>
  </main>

  <footer class="text-center py-4 mt-5 border-top">
    <div class="container">
      <small class="text-muted">Toolist &copy; <?= date("Y") ?>. All rights reserved.</small>
    </div>
  </footer>
</body>
</html>
