<?php
/**
 * src/Repositories/PlayerRepository.php
 * @author ADRAR - Sept 2020
 * @version 1.0.0
 *  Collectionne l'ensemble des joueurs de solitaire
 */

require_once(__DIR__ . '/../Models/PlayerModel.php');
require_once(__DIR__ . '/../Core/Database/PDOMySQL.php');
require_once(__DIR__ . '/../Core/Database/Repository/Repository.php');
class PlayerRepository extends Repository {

    public function __construct() {
        // Appeler explicitement le constructeur de la classe parente
        parent::__construct(substr(get_class($this), 0, strpos(get_class($this),'Repository')));
    }

    public function findByName(string $name): PlayerModel {
        $model = null; // Par défaut, on considère un model null
        
        foreach ($this->repository as $playerModel) {
            if ($playerModel->getName() === $name) {
                $model = $playerModel;
            }
        }
        return $model;
    }
}