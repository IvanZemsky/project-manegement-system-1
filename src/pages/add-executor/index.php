<?php

session_start();

$projectName = $_GET['project'];

if (!isset($_SESSION['projects'][$projectName])) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $executor_name = $_POST['executor_name'];

    $executor = [
        "name" => $executor_name,
    ];

    if (isset($_SESSION['projects'][$projectName])) {
        $_SESSION['projects'][$projectName]['executors'][] = $executor;
    }

    header("Location: board.php?project={$projectName}");
    exit();
}
?>

<div class="add-executor">
    <h2 class="add-executor__title">Executor adding</h2>
    <form method="POST" class="add-executor__form">
        <input type="text" class="base-input" placeholder="Name" id="executor_name" name="executor_name">
        <button class="add-executor__btn base-button">Create</button>
    </form>
</div>