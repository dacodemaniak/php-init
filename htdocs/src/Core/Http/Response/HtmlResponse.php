<?php
/**
 * src/Core/Http/Response/HtmlResponse.php
 *  Réponse HTTP spécifiques pour un contenu HTML
 */
require_once(__DIR__ . '/Response.php');
require_once(__DIR__ . '/../../Controllers/Controller.php');

class HtmlResponse extends Response {

    public function __construct(Controller $controller) {
        parent::__construct($controller);

        $this
            ->addHeader('Content-Type: text/html; charset=utf-8');
    }

    public function send() {
        $controller = $this->controller;
        
        $this->sendHeaders();

        ob_start();
        include(__DIR__ . '/../../../Views/base.view.php');
        $parsedTemplate = ob_get_contents();
        ob_end_clean();

        echo $parsedTemplate;
    }
}