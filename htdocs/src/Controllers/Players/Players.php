<?php
/**
 * src/Contollers/Players.php
 * @author ADRAR - Sept. 2020
 * @version 1.0.0
 *  Contrôleur pour la gestion des joueurs du Solitaire
 */
require_once(__DIR__ . '/../../Core/Controllers/Controller.php');
require_once(__DIR__ . '/../../Core/Http/Response/Response.php');
require_once(__DIR__ . '/../../Core/Http/Response/HtmlResponse.php');
require_once(__DIR__ . '/../../Repositories/PlayerRepository.php');
require_once(__DIR__ . '/../Menu/MenuController.php');

final class Players extends Controller {

    /**
     * @var PlayerRepository $repository
     *  Dépôt des données des joueurs
     */
    private $repository;


    public function __construct(){
        // Instancier le dépôt des données
        $this->repository = new PlayerRepository();

        // Instancier les contrôleurs "globaux" : menu, footer, etc...
        $this->globalControllers = [
            'menu' => new MenuController()
        ];
    }

    public function bestof(): Response {
        // Instancie une réponse
        $this->response = new HtmlResponse($this);

        // La vue complète se situe dans 'src/Views/base.view.php'
        $this->view = __DIR__ . '/Views/players.view.php';
        
        // Retourne l'objet Response
        return $this->response;
        
    }

    public function onePlayer() {
        $this->view = __DIR__ . '/Views/player.view.php';
        $this->renderView();
    }

    public function addPlayer() {
        $this->player = $this->repository->save();

        $this->view = __DIR__ . '/Views/add.json.php';
        $this->renderView();
    }

    public function getRepository(): PlayerRepository {
        return $this->repository;
    }

    /**
     * Définit la valeur de l'attribut privé "title"
     *  avec la valeur du paramètre "title" transmis
     * => setter
     */
    public function setTitle(string $title) {
        if (is_numeric($title)) {
            die('T\'es lourd ou quoi, on a dit string !');
        }

        $this->title = $title;
    }

    /**
     * Retourne la valeur "title" de l'objet courant (this)
     *  => getter
     */
    public function getTitle(): string {
        return $this->title;
    }

    public function setSubTitle(string $subtitle) {
        $this->subtitle = $subtitle;
    }

    public function getSubtitle(): string {
        return $this->subtitle;
    }

    public function htmlTitles(): string {
        return '<h1 class="my-title-class">' . $this->title . '</h1>' . '<h2>' . $this->subtitle . '</h2>';
    }
}