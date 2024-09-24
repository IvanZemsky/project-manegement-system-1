<?php

function task_card($project, $name, $executor, $stage) {
    $link = "edit-task.php?project={$project}&name={$name}&executor={$executor}&stage={$stage}";

    echo "<a href=\"{$link}\" class=\"border__card-link\">
            <div class=\"board__card\">
                <h4 class=\"board__card-task\">{$name}</h4>
                <p class=\"board__card-executor\">{$executor}</p>
            </div>
        </a>";
}