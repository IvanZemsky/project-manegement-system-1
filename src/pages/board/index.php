<?php
require_once "src/components/card.php";
require_once "src/pages/board/count-stages.php";
require 'src/db.php';

$projectId = $_GET['project'];

$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->execute([$projectId]);
$project = $stmt->fetch();

if (!$project) {
    header('Location: index.php');
    exit();
}

$stmt = $pdo->prepare("SELECT id, name, executor_id, stage FROM tasks WHERE project_id = ?");
$stmt->execute([$projectId]);
$tasks = $stmt->fetchAll();

$executorsStmt = $pdo->query("SELECT id, name FROM executors");
$executors = $executorsStmt->fetchAll(PDO::FETCH_KEY_PAIR); // создаем массив [id => name]

?>

<div class="board">
    <header class="board__header">
        <h2 class="board__title">
            <?php echo htmlspecialchars($project['name']); ?>
        </h2>
        <?php echo "<a class=\"base-button\" href=\"./create-task.php?project={$projectId}\">Create task</a>"; ?>
        <?php echo "<a class=\"base-button\" href=\"./add-executor.php?project={$projectId}\">Add executor</a>"; ?>
    </header>
    <div class="board__columns">
        <?php

        $stages = ['To do', 'In progress', 'Code review', 'Done'];

        foreach ($stages as $stage) {
            ?>
            <div class="board__column">
                <header class="board__column-header">
                    <h3 class="board__column-title">
                        <?php echo $stage; ?>
                    </h3>
                    <p class="board__column-amount">
                        <?php echo count_stages($tasks, $stage); ?>
                    </p>
                </header>

                <?php
                foreach ($tasks as $task) {
                    if ($task["stage"] === $stage) {
                        $executorName = $executors[$task["executor_id"]] ?? 'Unknown';
                        task_card($project['id'], $task['id'], $task["name"], $executorName);
                    }
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>