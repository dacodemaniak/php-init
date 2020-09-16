<?php
/**
 * src/Core/Http/Response.php
 *  Définition abstraite des réponses HTTP
 */
abstract class Response {
    /**
     * Collection des en-têtes HTTP à transmettre
     * @var array
     */
    protected $headers;

    /**
     * Contenu à transmettre
     * @var string
     */
    protected $content;

    /**
     * Statut HTTP à transmettre
     * @var int
     */
    protected $status = 200;

    /**
     * Définit le contenu à transmettre au serveur web
     */
    public function setContent(string $content) {
        $this->content = $content;
    }

    /**
     * A implémenter dans les classes filles
     *  - Envoyer les en-têtes
     *  - "echo" du contenu
     */
    abstract public function send();

    /**
     * Ajoute une en-tête HTTP à la collection
     * @return Response
     */
    protected function addHeader(string $header): Response {
        $this->headers[] = $header;
        return $this;
    }

    /**
     * Send HTTP headers to the webserver
     */
    protected function sendHeaders() {
        foreach ($this->headers as $header) {
            header($header);
        }
        http_response_code($this->status);
    }

    
}