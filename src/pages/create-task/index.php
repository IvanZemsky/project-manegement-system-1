<?php

session_start();

$projectName = $_GET['project'];

if (!isset($_SESSION['projects'][$projectName])) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $task_name = $_POST['task_name'];
    $executor = $_POST['executor'];
    $stage = $_POST['stage'];

    $task = [
        "name" => $task_name,
        "executor" => $executor,
        "stage" => $stage,
    ];

    if (isset($_SESSION['projects'][$projectName])) {
        if (!isset($_SESSION['projects'][$projectName]['tasks'])) {
            $_SESSION['projects'][$projectName]['tasks'] = [];
        }

        $_SESSION['projects'][$projectName]['tasks'][] = $task;
    }

    header("Location: board.php?project={$projectName}");
    exit();
}
?>

<div class="create-task">
    <h2 class="create-task__title">Task creation</h2>
    <form method="POST" class="create-task__form">
        <input type="text" class="base-input" placeholder="Name" id="task-name" name="task_name">
        <select name="executor" id="executor" class="base-input">
            <option value="Kopytin I. D.">Kopytin I. D.</option>
            <option value="Afanasyev D. P.">Afanasyev D. P.</option>
        </select>
        <select name="stage" id="stage" class="base-input">
            <option value="To do">To do</option>
            <option value="In progress">In progress</option>
            <option value="Code review">Code review</option>
            <option value="Done">Done</option>
        </select>
        <button class="create-task__btn base-button">Create</button>
    </form>
</div>