<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use WebDirectory\api\infrastructure\ConnectionBD;
use Tuupola\Middleware\CorsMiddleware;

/* application boostrap */

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

$app = (require_once __DIR__ . '/../conf/routes.php')($app);

ConnectionBD::init(__DIR__ . '/../conf/annuaire.db.conf.ini');

return $app;