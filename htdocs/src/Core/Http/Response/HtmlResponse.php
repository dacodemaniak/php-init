<?php
/**
 * src/Core/Http/Response/HtmlResponse.php
 *  Réponse HTTP spécifiques pour un contenu HTML
 */
require_once(__DIR__ . '/Response.php');

class HtmlResponse extends Response {

    public function __construct() {
        $this
            ->addHeader('Content-Type: text/html; charset=utf-8');
    }

    public function send() {
        $this->sendHeaders();
        echo $this->content;
    }
}