<?php
require 'src/db.php';

session_start();

$projectId = $_GET['project'];

$stmt = $pdo->prepare("SELECT name FROM projects WHERE id = ?");
$stmt->execute([$projectId]);
$project = $stmt->fetch();

if (!$project) {
    header('Location: index.php');
    exit();
}

$executorsStmt = $pdo->prepare("
    SELECT e.id, e.name 
    FROM executors e
    JOIN project_executors pe ON e.id = pe.executor_id 
    WHERE pe.project_id = ?
");
$executorsStmt->execute([$projectId]);
$executors = $executorsStmt->fetchAll(PDO::FETCH_KEY_PAIR);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $task_name = $_POST['task_name'];
    $executor_id = $_POST['executor'];
    $stage = $_POST['stage'];

    $executorCheckStmt = $pdo->prepare("SELECT * FROM executors WHERE id = ?");
    $executorCheckStmt->execute([$executor_id]);
    $executorExists = $executorCheckStmt->fetch();

    if ($executorExists) {
        $stmt = $pdo->prepare("INSERT INTO tasks (name, executor_id, stage, project_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$task_name, $executor_id, $stage, $projectId]);

        header("Location: board.php?project={$projectId}");
        exit();
    } else {
        echo "Executor does not exist.";
    }
}
?>

<div class="create-task">
    <h2 class="create-task__title">Task Creation</h2>
    <form method="POST" class="create-task__form">
        <input type="text" class="base-input" placeholder="Name" id="task-name" name="task_name" required>
        <select name="executor" id="executor" class="base-input" required>
            <?php foreach ($executors as $id => $name) {
                echo "<option value=\"{$id}\">{$name}</option>";
            } ?>
        </select>
        <select name="stage" id="stage" class="base-input" required>
            <option value="To do">To do</option>
            <option value="In progress">In progress</option>
            <option value="Code review">Code review</option>
            <option value="Done">Done</option>
        </select>
        <button class="create-task__btn base-button">Create</button>
    </form>
</div>
