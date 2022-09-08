<?php

require 'vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    // cote api angular
    $r->addRoute('GET', '/hello', '\Pabiosoft\Controller\FastController::direBonjour');
    $r->addRoute('GET', '/tableau', '\Pabiosoft\Controller\HomeController::direBonjour');
    $r->addRoute('GET', '/posts', '\Pabiosoft\Controller\ApiController::listePosts');
    $r->addRoute('GET', '/post/{id:\d+}', '\Pabiosoft\Controller\ApiController::unPost');
    $r->addRoute('GET', '/countPost', '\Pabiosoft\Controller\ApiController::nbPostApi');
    $r->addRoute('GET', '/troisDernier', '\Pabiosoft\Controller\ApiController::troisDernier');


    $r->addRoute('GET', '/style', '\Pabiosoft\Controller\StyleController::style');

    $r->addRoute(['GET', 'POST'], '/add', '\Pabiosoft\Controller\ApiController::addPostApi');
    $r->addRoute(['GET', 'POST'], '/signUp', '\Pabiosoft\Controller\ApiController::signUpApi');
    $r->addRoute(['GET', 'POST'], '/login', '\Pabiosoft\Controller\ApiController::listUsersApi');
    $r->addRoute(['GET', 'POST'], '/react', '\Pabiosoft\Controller\ApiController::reaction');
    $r->addRoute(['GET', 'POST'], '/like/{id:\d+}', '\Pabiosoft\Controller\ApiController::pusherLike');


    $r->addRoute('GET', '/messages', '\Pabiosoft\Controller\MessageController::getAllMessage');
    $r->addRoute(['GET','POST'], '/addMessage', '\Pabiosoft\Controller\MessageController::addMessage');
    $r->addRoute('GET', '/pusherMessage', '\Pabiosoft\Controller\MessageController::pusherMessage');



    //cote php visuel

    $r->addRoute('GET', '/admin', '\Pabiosoft\Controller\JokerController::listeAllSite');
    $r->addRoute(['GET','POST'], '/admin/insert', '\Pabiosoft\Controller\HomeController::ajout');
    $r->addRoute(['GET','POST'], '/admin/update', '\Pabiosoft\Controller\HomeController::update');
    $r->addRoute( 'GET', '/admin/delete/{id:\d+}', '\Pabiosoft\Controller\HomeController::delete');
    $r->addRoute(['GET','POST'], '/admin/like', '\Pabiosoft\Controller\HomeController::like');
    $r->addRoute(['GET','POST'], '/admin/signUp', '\Pabiosoft\Controller\UserController::inscription');
    $r->addRoute(['GET','POST'], '/admin/login', '\Pabiosoft\Controller\UserController::connexion');



    // joker sql requete

    $r->addRoute('GET', '/admin/joker/style', '\Pabiosoft\Controller\JokerController::listeAllStyle');
    $r->addRoute('GET', '/admin/joker/styleBySite', '\Pabiosoft\Controller\JokerController::styleBySite');
    $r->addRoute('GET', '/admin/joker/messageUser', '\Pabiosoft\Controller\JokerController::messageUser');
    $r->addRoute('GET', '/admin/joker/postUser', '\Pabiosoft\Controller\JokerController::postUser');



});


// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);



if($routeInfo[0] == FastRoute\Dispatcher::FOUND){
    // je verifie si mon parametre est une chaine de caratere
    if(is_string($routeInfo[1])){
        // si dans la chaine recue on trouve les ::
        if(strpos($routeInfo[1],'::') !== false){
            // on coupe par ::
            $route = explode('::',$routeInfo[1]);
            $method = [new $route[0],$route[1]];
        }else{
            // diretement la chaine
            $method = $routeInfo[1];
        }
        //var_dump($routeInfo[2]);
        call_user_func_array($method,$routeInfo[2]);
    }
}
elseif($routeInfo[0] == FastRoute\Dispatcher::NOT_FOUND){
    header("HTTP/1.0 404 Not Found");
    if(method_exists('\Pabiosoft\Controller\HomeController','error404')) {
        echo call_user_func([new \Pabiosoft\Controller\HomeController, 'error404']);
    } else {
        echo '<h1>404 Not Found</h1>';
        exit();
    }
}
elseif($routeInfo[0] == FastRoute\Dispatcher::METHOD_NOT_ALLOWED){
    header("HTTP/1.0 405 Method Not Allowed");
    if(method_exists('\Pabiosoft\Controller\HomeController','error405')) {
        echo call_user_func([new \Pabiosoft\Controller\HomeController, 'error405']);
    } else {
        echo '<h1>405 Method Not Allowed</h1>';
        exit();
    }
}


