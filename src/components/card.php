<?php

function task_card($projectId, $taskId, $name, $executor) {
    $link = "edit-task.php?project={$projectId}&task={$taskId}";

    echo "<a href=\"{$link}\" class=\"border__card-link\">
            <div class=\"board__card\">
                <h4 class=\"board__card-task\">{$name}</h4>
                <p class=\"board__card-executor\">{$executor}</p>
            </div>
        </a>";
}