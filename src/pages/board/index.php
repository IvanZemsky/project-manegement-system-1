<?php
require_once "src/components/card.php";
require_once "src/pages/board/count-stages.php";
session_start();

$projectName = $_GET['project'];

$project = $_SESSION['projects'][$projectName];

if (!isset($project)) {
    header('Location: index.php');
}

?>

<div class="board">
    <header class="board__header">
        <h2 class="board__title">
            <?php echo $projectName ?>
        </h2>
        <?php echo "<a class=\"base-button\" href=\"./create-task.php?project={$projectName}\">Create task</a>"; ?>
        <?php echo "<a class=\"base-button\" href=\"./add-executor.php?project={$projectName}\">Add executor</a>"; ?>
    </header>
    <div class="board__columns">
        <div class="board__column">
            <header class="board__column-header">
                <h3 class="board__column-title">
                    To do
                </h3>
                <p class="board__column-amount">
                    <?php echo count_stages($project['tasks'], 'To do') ?>
                </p>
            </header>

            <?php
            if (isset($project)) {
                foreach ($project['tasks'] as $task) {
                    if ($task["stage"] === "To do") {
                        task_card($projectName, $task["name"], $task["executor"], $task["stage"]);
                    }
                }
            }
            ?>

        </div>

        <div class="board__column">
            <header class="board__column-header">
                <h3 class="board__column-title">
                    In progress
                </h3>
                <p class="board__column-amount">
                    <?php echo count_stages($project['tasks'], 'In progress') ?>
                </p>
            </header>

            <?php
            if (isset($project)) {
                foreach ($project['tasks'] as $task) {
                    if ($task["stage"] === "In progress") {
                        task_card($projectName, $task["name"], $task["executor"], $task["stage"]);
                    }
                }
            }
            ?>
        </div>

        <div class="board__column">
            <header class="board__column-header">
                <h3 class="board__column-title">
                    Code review
                </h3>
                <p class="board__column-amount">
                    <?php echo count_stages($project['tasks'], 'Code review') ?>
                </p>
            </header>

            <?php
            if (isset($project)) {
                foreach ($project['tasks'] as $task) {
                    if ($task["stage"] === "Code review") {
                        task_card($projectName, $task["name"], $task["executor"], $task["stage"]);
                    }
                }
            }
            ?>
        </div>

        <div class="board__column">
            <header class="board__column-header">
                <h3 class="board__column-title">
                    Done
                </h3>
                <p class="board__column-amount">
                    <?php echo count_stages($project['tasks'], 'Done') ?>
                </p>
            </header>

            <?php
            if (isset($project)) {
                foreach ($project['tasks'] as $task) {
                    if ($task["stage"] === "Done") {
                        task_card($projectName, $task["name"], $task["executor"], $task["stage"]);
                    }
                }
            }
            ?>
        </div>
    </div>
</div>