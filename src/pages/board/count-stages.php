<?php

function count_stages($tasks, $stage) {
   return count(array_filter($tasks, function($task) use ($stage) {
      return $task['stage'] === $stage;
   }));
}