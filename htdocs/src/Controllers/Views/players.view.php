<?php
/**
 * src/Controllers/Views/players.view.php
 *  Vue avec les données des joueurs
 */
?>
<!doctype html>
<html lang="fr">
    <head>
        <title>Best of joueurs</title>
    </head>

    <body>
        <h1><?php echo $controller->getTitle(); ?></h1>
        <!-- Ce qui serait bien, serait de lister les players ! -->
        <ul>
            <?php
                foreach ($controller->getRepository()->findAll() as $player) {
                    echo '<li><a href="index.php?controller=players&name=' . $player->getName() . '" title="Voir le détail">';
                    echo $player->getName();
                    echo '</a></li>';
                }
            ?>
        </ul>
    </body>
</html>