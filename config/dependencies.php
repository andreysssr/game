<?php

use core\Container\Container;
use app\service\WikiApi;
use core\App\Cli\Application;
use core\EventManager\EventManager;
use core\Resolver\Resolver;

return [
//    Application::class => function (Container $container) {
//        return new Application(
//            $container->get(MiddlewareResolver::class),
//            $container->get(Framework\Http\Router\Router::class),
//            new Middleware\NotFoundHandler(),
//            new Zend\Diactoros\Response()
//        );
//    },

//    Application::class => function(Container $container){
//        return new Application($container->get(EventManager::class));
//    },
//
//    EventManager::class => function(Container $container){
//        return new EventManager($container, $container->get(Resolver::class));
//    },

//    'wiki' => function(Container $container){
//        return new Wiki($container->get('config')['wiki']);
//    },

//    // NextId $nextId, RepositoryGameMemory $repositoryGame RegisterGame
//    app\action\RegisterGame::class => function(Container $container){
//        return new RegisterGame($container->get(app\service\NextId::class), $container->get(app\service\NextId::class));
//    },

    // NextId $nextId, RepositoryGameMemory $repositoryGame RegisterGame
//    Container::class => function(Container $container){
//        return $container;
//    },




/*
    Router::class => function () {
        return new AuraRouterAdapter(new Aura\Router\RouterContainer());
    },

    MiddlewareResolver::class => function (Container $container) {
        return new MiddlewareResolver($container);
    },

    Middleware\BasicAuthMiddleware::class => function (Container $container) {
        return new Middleware\BasicAuthMiddleware($container->get('config')['users']);
    },

    Middleware\ErrorHandlerMiddleware::class => function (Container $container) {
        return new Middleware\ErrorHandlerMiddleware($container->get('config')['debug']);
    },*/
];
