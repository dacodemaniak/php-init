<?php
/**
 * src/Http/Request.php
 * @author ADRAR - Sept. 2020
 * @version 1.0.0
 *  Récupère les informations d'une requête HTTP
 */

require_once(__DIR__ . '/../Response/Response.php');

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
     * @var string $requestURI
     *  URI qui a conduit jusqu'à index.php
     */
    private $requestURI;

    /**
     * @var string $controllerName
     *  Nom du contrôleur à instancier
     */
    private $controllerName;

    /**
     * @var Controller $controller
     *  Instance du contrôleur
     */
    private $controller;

    /**
     * @var string $fallback
     *  Contrôleur par défaut à afficher si aucun contrôleur n'a été trouvé
     */
    private $fallback;

    /**
     * @var array $route
     *  Contient les "routes" de l'application
     */
    private $routes = [
        [
            'path' => '/players',
            'httpMethod' => 'GET',
            'controller' => 'Players',
            'method' => 'bestof',
            'pattern' => '#^/players$#'
        ],
        [
            'path' => '/players/{id}',
            'httpMethod' => 'GET',
            'controller' => 'Players',
            'method' => 'onePlayer',
            'pattern' => '#^/players/(?P<id>[0-9]+)$#'
        ],
        [
            'path' => '/players',
            'httpMethod' => 'POST',
            'controller' => 'Players',
            'method' => 'addPlayer',
            'pattern' => '#^/players#'
        ],        
    ];

    public function __construct(string $fallback = null) {
        $this->requestType = $_SERVER['REQUEST_METHOD'];
        $this->requestParams = $_GET;

        // On travaille avec des URI
        $this->requestURI = $_SERVER['REQUEST_URI'];
        
        

        $this->fallback = $fallback;

        $this->controller = $this->_traiterURI();

        //$this->_setControllerName(); // Définit le nom du fichier qui contient le contrôleur
    }

    /**
     * Exécute la méthode spécifiée du contrôleur instancié
     * @return Response
     */
    public function process(): Response {
        return $this->controller->invoke();
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

    /**
     * Retourne l'instance du Contrôleur
     * @return Controller
     */
    public function getController(): Controller {
        return $this->controller;
    }


    private function _traiterURI() {
        $laRoute = null;

        foreach ($this->routes as $route) {
            if ($route['httpMethod'] === $this->requestType) {
                // Try to match from regex
                if (preg_match($route['pattern'], $this->requestURI, $matches)) {
                    // Correspondance de motif trouvée
                    $laRoute = $route;
                    break;
                }
            }
        }

        // Si on a trouvé une route...
        if ($laRoute) {
            $controllerName = $laRoute['controller'] . '.php';
            $controller = $laRoute['controller'];
            
            // Pauvre implémentation de la méthode à utiliser dans le contrôleur
            $_GET['method'] = $laRoute['method'];

        } else {
            if (!is_null($this->fallback)) {
                $controllerName = $this->fallback . ".php";
                $controller = $this->fallback;
            } else {
                $controllerName = "NotFound.php";
                $controller = "NotFound";
            }            
        }
        // Requérir le fichier contenant la classe du contrôleur
        require_once(__DIR__ . '/../../../Controllers/' . $controller . '/' . $controllerName);

        // Retouner l'instanciation du contrôleur
        return new $controller();
    }
}