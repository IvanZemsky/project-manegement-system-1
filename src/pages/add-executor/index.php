<?php
require 'src/db.php';

$projectId = $_GET['project'];

$stmt = $pdo->prepare("SELECT name FROM projects WHERE id = ?");
$stmt->execute([$projectId]);
$project = $stmt->fetch();

if (!$project) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $executor_name = $_POST['executor_name'];

    $stmt = $pdo->prepare("INSERT INTO executors (name) VALUES (?)");
    $stmt->execute([$executor_name]);

    $executorId = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO project_executors (project_id, executor_id) VALUES (?, ?)");
    $stmt->execute([$projectId, $executorId]);

    header("Location: board.php?project={$projectId}");
    exit();
}
?>

<div class="add-executor">
    <h2 class="add-executor__title">Executor adding</h2>
    <form method="POST" class="add-executor__form">
        <input type="text" class="base-input" placeholder="Name" id="executor_name" name="executor_name" required>
        <button class="add-executor__btn base-button">Create</button>
    </form>
</div>