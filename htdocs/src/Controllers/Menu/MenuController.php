<?php
/**
 * src/Controllers/Menu/MenuController.php
 *  Contrôleur spécifique pour le menu
 */

require_once(__DIR__ . '/../../Core/Controllers/Controller.php');

class MenuController extends Controller {
    /**
     * Options du menu à afficher
     * @var array
     */
    private $menuOptions;

    public function __construct() {
        $this->menuOptions = [
            [
                'href' => '/home',
                'title' => 'Retour à la page d\'Accueil',
                'content' => 'Accueil'
            ],
            [
                'href' => '/players',
                'title' => 'Afficher la liste des joueurs',
                'content' => 'Hall of Fame'
            ],            
        ];

        // Définit la vue
        $this->view = __DIR__ . '/Views/menu.view.php';
    }

    /**
     * Retourne la liste des options de menu
     * @return array
     */
    public function getMenuOptions(): array {
        return $this->menuOptions;
    }
}