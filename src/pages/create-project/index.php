<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $project_name = $_POST['project_name'];

    $project = [
        "name" => $project_name,
        "tasks" => [],
    ];

    if (!isset($_SESSION['projects'])) {
        $_SESSION['projects'] = [];
    }

    $_SESSION['projects'][$project_name] = $project;

    header("Location: board.php?project={$project_name}");
    exit();
}
?>

<div class="create-project">
    <h2 class="create-project__title">Project creation</h2>
    <form method="POST" class="create-project__form">
        <input type="text" class="base-input" placeholder="Name" id="project_name" name="project_name">
        <button class="create-project__btn base-button">Create</button>
    </form>
</div>