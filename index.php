<?php
require 'autoload.php';
session_start();
DEFINE('DIR_ROOT', dirname(__FILE__));
DEFINE('URL_ROOT', 'http://127.0.0.1/DongeonXplorer');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




class Router
{
    private $getRoutes = [];
    private $postRoutes = [];
    private $prefix;
    private $middlewares = [];

    public function __construct($prefix = '')
    {
        $this->prefix = trim($prefix, '/');
    }

    // Ajouter une route GET
    public function addRouteGet($uri, $controllerMethod, $middlewares = [])
    {
        $this->getRoutes[trim($uri, '/')] = [
            'controllerMethod' => $controllerMethod,
            'middlewares' => $middlewares
        ];
    }

    // Ajouter une route POST
    public function addRoutePost($uri, $controllerMethod, $middlewares = [])
    {
        $this->postRoutes[trim($uri, '/')] = [
            'controllerMethod' => $controllerMethod,
            'middlewares' => $middlewares
        ];
    }

    // Ajouter un middleware global
    public function addMiddleware($middleware)
    {
        $this->middlewares[] = $middleware;
    }

    // Appliquer les middlewares
    private function applyMiddlewares($middlewares)
    {
        foreach ($middlewares as $middleware) {
            if (is_callable($middleware)) {
                call_user_func($middleware);
            }
        }

        // Appliquer les middlewares globaux
        foreach ($this->middlewares as $middleware) {
            if (is_callable($middleware)) {
                call_user_func($middleware);
            }
        }
    }

    // Routeur : gestion des routes
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
        foreach ($routes as $route => $data) {
            $controllerMethod = $data['controllerMethod'];
            $middlewares = $data['middlewares'];

            // Vérification de la correspondance de l'URL
            $routeParts = explode('/', $route);
            $urlParts = explode('/', $url);

            if (count($routeParts) === count($urlParts)) {
                $params = [];
                $isMatch = true;
                foreach ($routeParts as $index => $part) {
                    if (preg_match('/^{\w+}$/', $part)) {
                        $params[] = $urlParts[$index];
                    } elseif ($part !== $urlParts[$index]) {
                        $isMatch = false;
                        break;
                    }
                }

                if ($isMatch) {
                    // Appliquer les middlewares
                    $this->applyMiddlewares($middlewares);

                    // Extraire le nom du contrôleur et de la méthode
                    list($controllerName, $methodName) = explode('@', $controllerMethod);

                    // Instanciation du contrôleur et appel de la méthode
                    $controller = new $controllerName();
                    call_user_func_array([$controller, $methodName], $params);
                    return;
                }
            }
        }

        // Si aucune route n'a été trouvée, afficher une erreur 404
        require_once 'views/404.php';
    }
}

function checkAuth()
{
    if (!isset($_SESSION['user'])) {
        header('Location: login');
        exit();
    }
}

function checkNoAuth()
{
    if (isset($_SESSION['user'])) {
        header('Location: profil');
        exit();
    }
}

function checkNoHero()
{
    if (isset($_SESSION['user'])) {
        $user = new User($_SESSION['user']);
        if($user->possedeHero()){
            header('Location: profil');
            exit();
        } 
    }
}

function checkHero()
{
    if (isset($_SESSION['user'])) {
        $user = new User($_SESSION['user']);
        if(!$user->possedeHero()){
            header('Location: player_selection');
            exit();
        } 
    }
}


// Instanciation du routeur
$router = new Router('DongeonXplorer');

// Ajout des routes
$router->addRouteGet('profil', 'ProfilController@index', ['checkAuth']);
$router->addRoutePost('profil', 'ProfilController@changePP', ['checkAuth']);

$router->addRouteGet('delete_hero', 'ProfilController@deleteHero', ['checkAuth']);

$router->addRouteGet('player_selection', 'Player_selectionController@index',['checkAuth','checkNoHero']);
$router->addRoutePost('creation_hero', 'Player_selectionController@CreateHero',['checkAuth','checNokHero']);

$router->addRouteGet('home', 'HomeController@index');
$router->addRouteGet('', 'HomeController@index');

$router->addRouteGet('chapter', 'ChapterController@show', ['checkAuth','checkHero']);
$router->addRoutePost('chapter', 'ChapterController@show', ['checkAuth','checkHero']);

$router->addRouteGet('login', 'LoginController@index', ['checkNoAuth']); 
$router->addRoutePost('login', 'LoginController@login', ['checkNoAuth']);

$router->addRouteGet('logout', 'LoginController@logout', ['checkAuth']);  
//register
$router->addRouteGet('register', 'RegisterController@index', ['checkNoAuth']); 
$router->addRoutePost('register', 'RegisterController@register', ['checkNoAuth']); 

$router->addRoutePost('attack', 'CombatController@attack', ['checkAuth','checkHero']); 
$router->addRoutePost('cast_spell', 'CombatController@castSpell', ['checkAuth','checkHero']); 
$router->addRoutePost('use_item', 'CombatController@useItem', ['checkAuth','checkHero']);
$router->addRouteGet('attack', 'CombatController@show', ['checkAuth','checkHero']); 
$router->addRouteGet('cast_spell', 'CombatController@show', ['checkAuth','checkHero']); 
$router->addRouteGet('use_item', 'CombatController@show', ['checkAuth','checkHero']);


// Appel de la méthode route
$router->route(trim($_SERVER['REQUEST_URI'], '/'));
