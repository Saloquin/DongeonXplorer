<?php
session_start();
DEFINE('DIR_ROOT', dirname(__FILE__));
DEFINE('URL_ROOT', 'http://127.0.0.1/DongeonXplorer');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'models/User.php';
require 'autoload.php';


class Router
{
    private $getRoutes = [];
    private $postRoutes = [];
    private $prefix;

    public function __construct($prefix = '')
    {
        $this->prefix = trim($prefix, '/');
    }

    public function addRouteGet($uri, $controllerMethod)
    {
        $this->getRoutes[trim($uri, '/')] = $controllerMethod;
    }

    public function addRoutePost($uri, $controllerMethod)
    {
        $this->postRoutes[trim($uri, '/')] = $controllerMethod;
    }

    public function route($url)
    {
        // Enlève le préfixe du début de l'URL
        if ($this->prefix && strpos($url, $this->prefix) === 0) {
            $url = substr($url, strlen($this->prefix) + 1);
        }

        // Enlève les barres obliques en trop
        $url = trim($url, '/');

        $method = $_SERVER['REQUEST_METHOD'];
        $routes = $method === 'POST' ? $this->postRoutes : $this->getRoutes;

        // Vérification de la correspondance de l'URL à une route définie
        foreach ($routes as $route => $controllerMethod) {
            // Vérifie si l'URL correspond à une route avec des paramètres
            $routeParts = explode('/', $route);
            $urlParts = explode('/', $url);

            // Si le nombre de segments correspond
            if (count($routeParts) === count($urlParts)) {
                // Vérification de chaque segment
                $params = [];
                $isMatch = true;
                foreach ($routeParts as $index => $part) {
                    if (preg_match('/^{\w+}$/', $part)) {
                        // Capture les paramètres
                        $params[] = $urlParts[$index];
                    } elseif ($part !== $urlParts[$index]) {
                        $isMatch = false;
                        break;
                    }
                }

                if ($isMatch) {
                    // Extraction du nom du contrôleur et de la méthode
                    list($controllerName, $methodName) = explode('@', $controllerMethod);

                    // Instanciation du contrôleur et appel de la méthode avec les paramètres
                    $controller = new $controllerName();
                    call_user_func_array([$controller, $methodName], $params);
                    return;
                }
            }
        }

        // Si aucune route n'a été trouvée, gérer l'erreur 404
        require_once 'views/404.php';
    }
}



// Instanciation du routeur
$router = new Router('DongeonXplorer');

// Ajout des routes
$router->addRouteGet('profil', 'ProfilController@index');
$router->addRouteGet('player_selection', 'Player_selectionController@index');

$router->addRouteGet('home', 'HomeController@index');
$router->addRouteGet('', 'HomeController@index');

$router->addRouteGet('chapter/{id}', 'ChapterController@show');
$router->addRouteGet('login', 'LoginController@index'); 
$router->addRoutePost('login', 'LoginController@login');
$router->addRouteGet('logout', 'LoginController@logout');  
//register
$router->addRouteGet('register', 'RegisterController@index'); 
$router->addRoutePost('register', 'RegisterController@register'); 


// Appel de la méthode route
$router->route(trim($_SERVER['REQUEST_URI'], '/'));
