<?php
/**
 * src/Controllers/Views/players.view.php
 *  Vue avec les données des joueurs
 * @version 1.1.0 - 2020-09-16
 *  Réduction de la vue à la seule partie "métier" concernée
 */
?>
<!-- Ce qui serait bien, serait de lister les players ! -->
<ul class="list-group xs-12">
    <?php
        foreach ($controller->getRepository()->findAll() as $player) {
            echo '<li class="list-group-item">';
            echo '<a href="index.php?controller=players&method=onePlayer&id=' . $player->getId() . '" title="Voir le détail" data-original-title="' . $player->getName() . '" data-content="' . $player->getTime() . '" data-toggle="popover" data-trigger="hover">';
            echo $player->getName();
            echo '</a></li>';
        }
    ?>
</ul>