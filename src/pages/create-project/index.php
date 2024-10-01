<?php

session_start();

require_once "src/db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $project_name = $_POST['project_name'];

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM projects WHERE name = ?");
    $stmt->execute([$project_name]);
    $exists = $stmt->fetchColumn();

    if ($exists) {
        echo "Project with this name already exists!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO projects (name) VALUES (?)");
        $stmt->execute([$project_name]);

        $project_id = $pdo->lastInsertId();

        header("Location: board.php?project={$project_id}");
        exit();
    }
}
?>

<div class="create-project">
    <h2 class="create-project__title">Project creation</h2>
    <form method="POST" class="create-project__form">
        <input type="text" class="base-input" placeholder="Name" id="project_name" name="project_name">
        <button class="create-project__btn base-button">Create</button>
    </form>
</div>