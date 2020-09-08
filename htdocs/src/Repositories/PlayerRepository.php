<?php
/**
 * src/Repositories/PlayerRepository.php
 * @author ADRAR - Sept 2020
 * @version 1.0.0
 *  Collectionne l'ensemble des joueurs de solitaire
 */

require_once(__DIR__ . '/../Models/PlayerModel.php');

class PlayerRepository {
    /**
     * @var array $repository
     *  Tableau qui contient l'ensemble des objets PlayerModel
     */
    private $repository;

    public function __construct() {
        $this->repository = []; // Initialise le repository

        // Hydrate la collection des Players
        $this->_hydrate();
    }

    public function getRepository(): array {
        return $this->repository;
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

    public function findAll(): array {
        return $this->repository;
    }
    
    private function _hydrate() {
        $this->repository[] = new PlayerModel('Jean-Luc', new \DateTime());
        $this->repository[] = new PlayerModel('Murielle', new \DateTime());
        $this->repository[] = new PlayerModel('Alphonse', new \DateTime());
        // Ancienne façon d'ajouter un élément dans un tableau PHP (fonctionnel)
        array_push($this->repository, new PlayerModel('Maurice', new \DateTime()));
    }

}