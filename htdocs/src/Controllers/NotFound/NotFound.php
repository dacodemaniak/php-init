<?php
/**
 * src/Controllers/NotFound.php
 */
require_once(__DIR__ . '/../../Core/Controllers/Controller.php');
require_once(__DIR__ . '/../../Core/Controllers/InvocableInterface.php');
require_once(__DIR__ . '/../../Core/Http/Response/Response.php');
require_once(__DIR__ . '/../../Core/Http/Response/HtmlResponse.php');
require_once(__DIR__ . '/../Menu/MenuController.php');

class NotFound extends Controller implements InvocableInterface {

    public function __construct() {
        $this->view = __DIR__ . '/Views/notfound.view.php';

        // Instancier les contrôleurs "globaux" : menu, footer, etc...
        $this->globalControllers = [
            'menu' => new MenuController()
        ];
    }

    public function notFound() {
        $this->response = new HtmlResponse($this);

        // Retourne l'objet Response
        return $this->response;
    }
}