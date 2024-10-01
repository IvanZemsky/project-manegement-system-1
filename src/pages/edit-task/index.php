<?php

session_start();

$projectName = $_GET['project'];

if (!isset($_SESSION['projects'][$projectName])) {
    header('Location: index.php');
}

$name = $_GET['name'];
$current_executor = $_GET['executor'];
$stage  = $_GET['stage'];

$executors = $_SESSION['projects'][$projectName]['executors'];

$stages = [
    "To do",
    "In progress",
    "Code review",
    "Done",
];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $task_name = $_POST['task_name'];
    $executor_name = $_POST['executor'];
    $stage = $_POST['stage'];

    if (isset($_SESSION['projects'][$projectName])) {
        foreach ($_SESSION['projects'][$projectName]['tasks'] as &$task) {
            if ($task['name'] === $name) {
                $task['name'] = $task_name;
                $task['executor'] = $executor_name;
                $task['stage'] = $stage;
                break;
            }
        }
    }

    header("Location: board.php?project={$projectName}");
    exit();
}
?>

<div class="edit-task">
    <h2 class="edit-task__title">Task creation</h2>
    <form method="POST" class="edit-task__form">
        <input type="text" class="base-input" placeholder="Name" id="task-name" name="task_name" value="<?php echo htmlspecialchars($name); ?>">
        <select name="executor" id="executor" class="base-input">
        <?php
            foreach($executors as $executor) {
                $selected = $current_executor === $executor ? 'selected="selected"' : '';
                echo "<option value=\"{$executor['name']}\" {$selected}>{$executor['name']}</option>";
            }
        ?>
        </select>
        <select name="stage" id="stage" class="base-input">
        <?php
            foreach($stages as $value) {
                $selected = $value === $stage ? 'selected="selected"' : '';
                echo "<option value=\"{$value}\" {$selected}>{$value}</option>";
            }
        ?>
        </select>
        <button class="edit-task__btn base-button">Save</button>
    </form>
</div>