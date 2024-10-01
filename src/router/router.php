<?php

$routes = [
    '/project-management-system/index.php' => './src/pages/projects/index.php',
    '/project-management-system/board.php' => './src/pages/board/index.php',
    '/project-management-system/add-executor.php' => './src/pages/add-executor/index.php',
    '/project-management-system/create-project.php' => './src/pages/create-project/index.php',
    '/project-management-system/create-task.php' => './src/pages/create-task/index.php',
    '/project-management-system/edit-task.php' => './src/pages/edit-task/index.php',
];

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
} else {
    http_response_code(404);

    echo "Page not found";
}

