<?php
require_once "src/components/project-card.php";
require 'src/db.php';

$stmt = $pdo->query("SELECT id, name FROM projects");
$projects = $stmt->fetchAll();
?>

<div class="projects">
   <header class="projects__header">
      <h2 class="projects__title">
         Projects
      </h2>
      <a class="base-button" href="./create-project.php">Create</a>
   </header>
   <ul class="projects__list">
      <?php
      if ($projects) {
         foreach ($projects as $project) {
            project_card($project["name"], $project["id"]);
         }
      } else {
         echo "<p>You haven't created any projects yet</p>";
      }
      ?>
</div>