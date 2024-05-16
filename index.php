<?php

use App\Controllers\Loan\CreateController;
use App\Controllers\Loan\DeleteController;
use App\Controllers\Loan\IndexController;
use App\Controllers\Loan\ShowController;
use App\Controllers\Loan\UpdateController;
use App\Middleware\AddJsonResponseHeader;
use Slim\Factory\AppFactory;
use DI\ContainerBuilder;
use Slim\Handlers\Strategies\RequestResponseArgs;
use Slim\Routing\RouteCollectorProxy;

require './vendor/autoload.php';

$builder = new ContainerBuilder();
$container = $builder->addDefinitions('./config/definitions.php')->build();

AppFactory::setContainer($container);
$app = AppFactory::create();

$routeCollector = $app->getRouteCollector();
$routeCollector->setDefaultInvocationStrategy(new RequestResponseArgs());

$app->addBodyParsingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->forceContentType('application/json');
$app->add(new AddJsonResponseHeader());

$app->group('/api', function (RouteCollectorProxy $group) {
    $group->get('/loans', IndexController::class);
    $group->get('/loans/{id:[0-9]+}', ShowController::class);
    $group->post('/loans', CreateController::class);
    $group->put('/loans/{id:[0-9]+}', UpdateController::class);
    $group->delete('/loans/{id:[0-9]+}', DeleteController::class);
});

$app->run();