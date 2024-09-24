<?php

$current_page = basename($_SERVER['PHP_SELF']);

$menu_items = [
    'index.php' => 'Projects',
];
?>

<nav class="menu">
    <ul class="menu__list">
        <?php foreach ($menu_items as $page => $title): ?>
            <li class="menu__item <?php echo $current_page === $page ? 'menu__item--active' : ''; ?>">
                <a href="<?php echo $page; ?>"><?php echo $title; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>