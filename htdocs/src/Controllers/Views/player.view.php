<?php
/**
 * src/Controllers/Views/players.view.php
 *  Vue avec les données des joueurs
 */
?>
<!doctype html>
<html lang="fr">
    <head>
        <title>Player</title>
    </head>

    <body>
        <h1>Un joueur</h1>
        <!-- Ce qui serait bien, serait de lister les players ! -->
        <ul>
            <?php
                echo '<strong>' . $controller->getRepository()->findByName($_GET["name"])->getName() . '</strong>';
                echo ' : ' . $controller->getRepository()->findByName($_GET["name"])->getTime();
            ?>
        </ul>
    </body>
</html>