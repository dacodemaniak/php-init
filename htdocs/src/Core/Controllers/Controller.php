<?php
/**
 * src/Core/Controllers/Controller.php
 *  Classe parente qui définit le modèle de TOUS les contrôleurs
 */

 require_once(__DIR__ . '/../Http/Response/Response.php');

abstract class Controller {
    /**
     * @var string $view
     *  Le chemin vers la vue associée au contrôleur
     */
    protected $view;

    private $parseTemplate;

    /**
     * @var array $stylesheets
     *  Contient la collection des feuilles de style à utiliser
     */
    private $stylesheets = [
        [
            'href' => 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css',
            'integrity' => 'sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z',
            'crossorigin' => 'anonymous'
        ]
    ];

    private $javascripts = [
        [
            'href' => 'https://code.jquery.com/jquery-3.5.1.slim.min.js',
            'integrity' => 'sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj',
            'crossorigin' => 'anonymous'
        ],
        [
            'href' => 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js',
            'integrity' => 'sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN',
            'crossorigin' => 'anonymous'
        ],
        [
            'href' => 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js',
            'integrity' => 'sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV',
            'crossorigin' => 'anonymous'
        ]
    ];

    /**
     * @var boolean $enablePopover
     *  Détermine si oui ou non les popovers sont activés
     */
    private $enablePopover = true;

    public function isPopoverEnabled(): bool {
        return $this->enablePopover;
    }

    public function togglePopover() {
        $this->enablePopover = !$this->enablePopover;
    }

    protected function renderView(): string {
        $controller = $this; // Définit une variable égale au contrôleur courant
        $stylesheets = $this->stylesheets;
        $scripts = $this->javascripts;
        ob_start();
        include($this->view);
        $this->parseTemplate = ob_get_contents();
        ob_end_clean();

        return $this->parseTemplate;
    }

    public function getStylesheets(): array {
        return $this->stylesheets;
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

    public function sendResponse() {
        //header('Content-Type: text/html', false, 200);
        header('Access-Control-Allow-Origin: http://127.0.0.1:8080');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, OPTIONS');
        
        echo $this->parseTemplate;
    }
}