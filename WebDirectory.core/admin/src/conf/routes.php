<?php

declare(strict_types=1);


use Slim\App;
use WebDirectory\admin\app\actions\AuthGETAction;
use WebDirectory\admin\app\actions\AuthPOSTAction;
use WebDirectory\admin\app\actions\CreateDepartementPOSTAction;
use WebDirectory\admin\app\actions\CreateDepartementGETAction;
use WebDirectory\admin\app\actions\CreateEntryGETAction;
use WebDirectory\admin\app\actions\CreateEntryPOSTAction;
use WebDirectory\admin\app\actions\listEntriesAction;

return function (App $app): \Slim\App {

    $app->get(
        '/createEntry',
        CreateEntryGETAction::class
    )->setName('createEntryGET');

    $app->post(
        '/createEntry',
        CreateEntryPOSTAction::class
    )->setName('createEntryPOST');

    $app->get(
        '/createDepartment',
        CreateDepartementGETAction::class
    )->setName('createDepartmentGET');

    $app->post(
        '/createDepartment',
        CreateDepartementPOSTAction::class
    )->setName('createDepartmentPOST');

    $app->get(
        '/listEntries',
        listEntriesAction::class
    )->setName('listEntries');

    $app->get(
        '/auth',
        AuthGETAction::class
    )->setName('auth');

    $app->post(
        '/auth',
        AuthPOSTAction::class
    )->setName('authPOST');

    return $app;
};