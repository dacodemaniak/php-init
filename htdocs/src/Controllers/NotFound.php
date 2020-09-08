<?php
/**
 * src/Controllers/NotFound.php
 */
require_once(__DIR__ . '/../Core/Controllers/Controller.php');

class NotFound extends Controller {

    public function __construct() {
        $this->view = __DIR__ . '/Views/notfound.view.php';
    }
}