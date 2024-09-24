<?php
require_once "src/components/project-card.php";
session_start();
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
      if (isset($_SESSION['projects'])) {
         foreach ($_SESSION['projects'] as $project) {
            project_card($project["name"]);
         }
      }
      ?>
   </ul>
   <?php if (!isset($_SESSION['projects'])) {
      echo "<p>You haven't created any projects yet</p>";
   } ?>
</div>