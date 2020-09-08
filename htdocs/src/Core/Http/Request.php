<?php
/**
 * src/Http/Request.php
 * @author ADRAR - Sept. 2020
 * @version 1.0.0
 *  Récupère les informations d'une requête HTTP
 */
class Request {
    /**
     * @var string $requestType
     *  Type de la requête HTTP : GET | POST | PUT | DELETE | PATCH
     */
    private $requestType;

    /**
     * @var array $requestParams
     *  Collection des paramètres de la requête HTTP (QueryString)
     */
    private $requestParams;

    /**
     * @var string $controllerName
     *  Nom du contrôleur à instancier
     */
    private $controllerName;

    /**
     * @var string $controller
     *  Nom de la classe à instancier
     */
    private $controller;

    public function __construct() {
        $this->requestType = $_SERVER['REQUEST_METHOD'];
        $this->requestParams = $_GET;

        $this->_setControllerName(); // Définit le nom du fichier qui contient le contrôleur
    }

    public function getRequestType(): string {
        return $this->requestType;
    }

    public function getRequestParams(): string {
        $output = '';

        foreach ($this->requestParams as $requestParam => $value) {
            $output .= $requestParam . ' : ' . $value . "<br>";
        }

        return $output;
    }

    public function getControllerName(): string {
        return $this->controllerName;
    }

    public function getController(): string {
        return $this->controller;
    }

    private function _setControllerName() {
        if (array_key_exists('controller', $this->requestParams)) {
            $name = $this->requestParams['controller']; // Récupère la valeur associée à la clé controller
            $this->controllerName = ucfirst($name) . '.php';
            if (file_exists(__DIR__ . '/../../Controllers/' . $this->controllerName)) {
                $this->controller = ucfirst($name);
            } else {
                $this->controllerName = 'NotFound.php';
                $this->controller = 'NotFound';
            }
            
        } else {
            $this->controllerName = 'NotFound.php'; // Fallback (par défaut, ce sera NotFound.php)
            $this->controller = 'NotFound';
        }
    }
}