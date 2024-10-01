<?php
require 'src/db.php';

session_start();

$projectId = $_GET['project'];
$taskId = $_GET['task'];

$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->execute([$projectId]);
$project = $stmt->fetch();

if (!$project) {
    header('Location: index.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? AND project_id = ?");
$stmt->execute([$taskId, $projectId]);
$task = $stmt->fetch();

if (!$task) {
    header('Location: board.php?project=' . $projectId);
    exit();
}

$stmt = $pdo->prepare("
    SELECT e.id, e.name 
    FROM executors e
    JOIN project_executors pe ON e.id = pe.executor_id 
    WHERE pe.project_id = ?
");
$stmt->execute([$projectId]);
$executors = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stages = [
    "To do",
    "In progress",
    "Code review",
    "Done",
];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $task_name = $_POST['task_name'];
    $executor_id = $_POST['executor'];
    $stage = $_POST['stage'];

    $stmt = $pdo->prepare("SELECT * FROM executors WHERE id = ?");
    $stmt->execute([$executor_id]);
    $executorExists = $stmt->fetch();

    if ($executorExists) {
        $stmt = $pdo->prepare("UPDATE tasks SET name = ?, executor_id = ?, stage = ? WHERE id = ?");
        $stmt->execute([$task_name, $executor_id, $stage, $taskId]);

        header("Location: board.php?project={$projectId}");
        exit();
    } else {
        echo "Executor does not exist.";
    }
}
?>

<div class="edit-task">
    <h2 class="edit-task__title">Edit Task</h2>
    <form method="POST" class="edit-task__form">
        <input type="text" class="base-input" placeholder="Name" id="task-name" name="task_name" value="<?php echo htmlspecialchars($task['name']); ?>">
        <select name="executor" id="executor" class="base-input">
        <?php
            foreach ($executors as $executor) {
                $selected = $executor['id'] === $task['executor_id'] ? 'selected="selected"' : '';
                echo "<option value=\"{$executor['id']}\" {$selected}>{$executor['name']}</option>";
            }
        ?>
        </select>
        <select name="stage" id="stage" class="base-input">
        <?php
            foreach ($stages as $value) {
                $selected = $value === $task['stage'] ? 'selected="selected"' : '';
                echo "<option value=\"{$value}\" {$selected}>{$value}</option>";
            }
        ?>
        </select>
        <button class="edit-task__btn base-button">Save</button>
    </form>
</div>
