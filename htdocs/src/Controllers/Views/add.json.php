<?php
/**
 * Set a JSON response
 */
?>
{
    "status": 200,
    "message": "Le joueur a bien été créé !",
    "payload": {
        "id": <?php echo $controller->player->getId()?>,
        "name": <?php echo $controller->player->getName()?>,
        "time": <?php echo $controller->player->getTime()?>
    }
}