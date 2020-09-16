<?php
/**
 * src/Core/Controllers/Controller.php
 *  Classe parente qui définit le modèle de TOUS les contrôleurs
 */
require_once(__DIR__ . '/InvocableInterface.php');
require_once(__DIR__ . '/../Http/Response/Response.php');

abstract class Controller implements InvocableInterface {
    /**
     * @var string $view
     *  Le chemin vers la vue associée au contrôleur
     */
    protected $view;

    /**
     * Collection des contrôleurs globaux : menu, footer, etc...
     */
    protected $globalControllers = [];


    /**
     * Instance d'une réponse HTTP
     * @var Response
     */
    protected $response;

    /**
     * Parse les templates spécifiques, appelée dans base.view.php
     */
    public function renderView(): string {
        $controller = $this; // Définit une variable égale au contrôleur courant

        ob_start();
        include($this->view);
        $parsedTemplate = ob_get_contents();
        ob_end_clean();

        return $parsedTemplate;
    }

    /**
     * Retourne la liste des contrôleurs "globaux"
     * @return array
     */
    public function getGlobalControllers(): array {
        return $this->globalControllers;
    }

    public function invoke(array $args = []): Response {
        $method = array_key_exists('method', $_GET) ? $_GET['method'] : 'bestof';
        return call_user_func_array(
            [
                $this,
                $method
            ], // Le nom de la méthode ($method) de l'objet courant ($this)
            $args // Les paramètres éventuels à transmettre à cette méthode
        );
    }
}