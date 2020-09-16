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

    public function save(): PlayerModel {
        // Récupérer les données du "frontend"
        $input = json_decode(file_get_contents('php://input'));
        
        $sqlQuery = 'INSERT INTO ' . $this->table . '(';
        foreach ($this->cols as $col) {
            $sqlQuery .= $col . ',';
        }
        // Ne pas oublier d'enlever la dernière virgule inutile
        $sqlQuery = substr($sqlQuery, 0, strlen($sqlQuery) - 1);

        // Continuer la requête
        $sqlQuery .= ') VALUES (';
        foreach ($this->cols as $col) {
            $sqlQuery .= ':' . $col . ',';
        }
        // Ne pas oublier d'enlever la dernière virgule inutile
        $sqlQuery = substr($sqlQuery, 0, strlen($sqlQuery) - 1);
        
        // Terminer la requête
        $sqlQuery .= ');';

        // INSERT INTO player (id,name,time) VALUES (:id,:name,:time);

        // Affecter les valeurs à chaque placeholder
        $values = [];
        foreach ($this->cols as $col) {
            if ($col === 'id') {
                $values[$col] = null;
            } else {
               $values[$col] = $input->{$col}; 
            }
        }
        // Le tableau sera :
        // ['id' => null, 'name' => 'Casper le fantôme', 'time'=>'00:15:43']

        // On peut préparer la requête et l'exécuter
        $statement = $this->db->prepare($sqlQuery);
        $statement->execute($values);

        // How to... Get the last one of Players to return it
        // Just put the logic in your AbstractRepository and... play
        $player = new PlayerModel();

        $player->setId($this->getLastInsert()["id"]);
        $player->setName($input->name);
        $player->setTime(\DateTime::createFromFormat('H:i:s', $input->time));

        return $player;
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