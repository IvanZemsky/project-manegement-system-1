<?php

function project_card($name, $id) {
    $link = "board.php?project={$id}";

    echo "<a href=\"{$link}\" class=\"projects__card\">
            <h2 class=\"projects__card-title\">
                {$name}
            </h2>
            <button class=\"base-button projects__card-delete-btn\">Delete</button>
        </a>";
}