<?php

declare(strict_types=1);


use Slim\App;
use WebDirectory\api\app\actions\GetDepartmentById;
use WebDirectory\api\app\actions\GetEntryById;
use WebDirectory\api\app\actions\GetFile;
use WebDirectory\api\app\actions\GetListEntries;
use WebDirectory\api\app\actions\GetListDepartments;


return function (App $app): \Slim\App {


    $app->get(
        '/api/entry/all',
        GetListEntries::class
    )->setName('liste_entries');
    $app->get(
        '/api/department/all',
        GetListDepartments::class
    )->setName('liste_departments');
    $app->get(
        '/api/department/id/{id}',
        GetDepartmentById::class
    )->setName('entrie');
    $app->get(
        '/api/files/{file}',
        GetFile::class
    )->setName('file');
    $app->get(
        '/api/entry/id/{id}',
        GetEntryById::class
    )->setName('entry');

    return $app;
};