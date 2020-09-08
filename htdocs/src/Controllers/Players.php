<?php
/**
 * src/Contollers/Players.php
 * @author ADRAR - Sept. 2020
 * @version 1.0.0
 *  Contrôleur pour la gestion des joueurs du Solitaire
 */
require_once(__DIR__ . '/../Core/Controllers/Controller.php');

final class Players extends Controller {
    /**
     * @var string $title
     *  Titre qui sera passé à la vue
     */
    private $title = 'Hall of Fame';

    private $subtitle;


    public function __construct(){
        $this->view = __DIR__ . '/Views/players.view.php';
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