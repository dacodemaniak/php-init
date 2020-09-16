<?php
/**
 * src/Controllers/NotFound.php
 */
require_once(__DIR__ . '/../Core/Controllers/Controller.php');
require_once(__DIR__ . '/../Core/Controllers/InvocableInterface.php');

class NotFound extends Controller implements InvocableInterface {

    public function __construct() {
        $this->view = __DIR__ . '/Views/notfound.view.php';
    }

    public function notFound() {
        $this->renderView();
    }
}