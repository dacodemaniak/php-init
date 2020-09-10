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

    /**
     * Override
     *  @see Repository::findAll()
     */
    public function findAll(): array {
        $results = parent::findAll();

        foreach ($results as $row) {
            $player = new PlayerModel();
            $player->setName($row['name']);
            $player->setTime(\DateTime::createFromFormat('H:i:s',$row['time']));

            $this->repository[] = $player;
        }

        return $this->repository;
    }

    public function findById(int $id): PlayerModel {
        $sqlQuery = 'SELECT ' . implode(',', $this->cols) . ' FROM ' . $this->table . ' WHERE id = :id;';

        $statement = $this->db->prepare($sqlQuery);

        $result = $statement->fetchAll();

        // Exécuter la requête préparée
        $statement->execute(['id' => $id]);

        return new PlayerModel($result[0]['name'], \DateTime::createFromFormat('H:i:s', $result[0]['time']));
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

    
    private function _hydrate() {
        $this->repository[] = new PlayerModel('Jean-Luc', new \DateTime());
        $this->repository[] = new PlayerModel('Murielle', new \DateTime());
        $this->repository[] = new PlayerModel('Alphonse', new \DateTime());
        // Ancienne façon d'ajouter un élément dans un tableau PHP (fonctionnel)
        array_push($this->repository, new PlayerModel('Maurice', new \DateTime()));
    }

}