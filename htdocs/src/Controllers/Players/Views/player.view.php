<?php
/**
 * src/Controllers/Views/players.view.php
 *  Vue avec les données des joueurs
 */
?>
<h1>Un joueur</h1>
<!-- Ce qui serait bien, serait de lister les players ! -->
<p>
    <strong><?php echo $controller->player->getName(); ?></strong> : <?php echo ' : ' . $controller->player->getTime();?>
</p>