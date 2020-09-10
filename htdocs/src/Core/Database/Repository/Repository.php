<?php
/**
 * src/Core/Database/Repository/Repository
 *  Abstraction de Repository
 */
abstract class Repository {
    protected $cols;

    protected $table;

    protected $db;

    /**
     * @var array $repository
     *  Tableau qui contient l'ensemble des objets PlayerModel
     */
    protected $repository;

    /**
     * @var string $modelClass
     *  Contient le nom de la classe du modèle à traiter
     */
    private $modelClass;

    public function __construct(string $model){

        $this->repository = []; // Initialise le repository

        // Connexion à la base de données
        $connexion = new PDOMySQL();
        $connexion->connect();
        $this->db = $connexion->getInstance();

        $this->modelClass = $model . 'Model';
        
        // Requiert le fichier qui contient la classe du modèle à traiter
        require_once(__DIR__ . '/../../../Models/' . $this->modelClass . '.php');
        $instance = $this->modelClass;
        $modelInstance = new $instance(); // i.e new PlayerModel()
        
        // Récupérer les colonnes
        $this->cols = $modelInstance->getCols();

        $this->table = strtolower($model);
    }

    public function getRepository(): array {
        return $this->repository;
    }

    public function findAll() {
        $sqlQuery = 'SELECT ' . implode(',', $this->cols) . ' FROM ' . $this->table . ';';
        $results = $this->db->query($sqlQuery);

        return $results;
    }

    public function findById(int $id) {}
}