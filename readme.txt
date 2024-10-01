База данных

CREATE TABLE executors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    stage VARCHAR(50) NOT NULL,
    project_id INT,
    executor_id INT,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (executor_id) REFERENCES executors(id) ON DELETE SET NULL
);

CREATE TABLE project_executors (
    project_id INT,
    executor_id INT,
    PRIMARY KEY (project_id, executor_id),
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (executor_id) REFERENCES executors(id) ON DELETE CASCADE
);

конфигурация подключения в src/db.php