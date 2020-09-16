<?php
/**
 * src/Controllers/Menu/Views/menu.view.php
 */
?>

<nav>
    <ul>
        <?php
        foreach ($controller->getMenuOptions() as $menuOption) { ?>
            <li>
                <a href="<?php echo $menuOption['href']; ?>" title="<?php echo $menuOption['title']; ?>">
                    <?php echo $menuOption['content']; ?>
                </a>
            </li>
        <?php }
        ?>
    </ul>
</nav>