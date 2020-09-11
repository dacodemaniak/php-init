<?php
/**
 * src/Repositories/PlayerRepository.php
 * @author ADRAR - Sept 2020
 * @version 1.1.0
 *  Collectionne l'ensemble des joueurs de solitaire
 * Update Sept. 2020 :
 *  - Généralisation du repository dans src/Core/Database/Repository/Repository.php
 *  - Mise à jour de la méthode findByName()
 */

require_once(__DIR__ . '/../Models/PlayerModel.php');
require_once(__DIR__ . '/../Core/Database/PDOMySQL.php');
require_once(__DIR__ . '/../Core/Database/Repository/Repository.php');
class PlayerRepository extends Repository {

    public function __construct() {
        // Appeler explicitement le constructeur de la classe parente
        parent::__construct(substr(get_class($this), 0, strpos(get_class($this),'Repository')));
    }

    public function findByName(string $name): ?array {
        $sqlQuery = 'SELECT ' . implode(',', $this->cols) . ' FROM ' . $this->table;
        $sqlQuery .= ' WHERE name LIKE :name;';

        $statement = $this->db->prepare($sqlQuery)
            ->execute(['name' => '%' . $name . '%']);

        if ($statement) {
            while($row = $statement->fetch()) {
                $this->repository[] = new PlayerModel($row);
            }
        }
        return $this->repository;
    }
}