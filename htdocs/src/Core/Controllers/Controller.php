<?php
/**
 * src/Core/Controllers/Controller.php
 *  Classe parente qui définit le modèle de TOUS les contrôleurs
 */
abstract class Controller {
    /**
     * @var string $view
     *  Le chemin vers la vue associée au contrôleur
     */
    protected $view;

    public function renderView() {
        $controller = $this; // Définit une variable égale au contrôleur courant
        include($this->view);
    }
}