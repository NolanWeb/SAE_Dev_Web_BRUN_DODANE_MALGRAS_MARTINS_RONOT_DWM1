<?php

namespace WebDirectory\api\app\actions;

use WebDirectory\api\core\services\annuaire\AnnuaireService;

class GetDepartmentById extends Action
{
    private AnnuaireService $departmentService;

    public function __construct()
    {
        $this->departmentService = new AnnuaireService();
    }

    public function __invoke($request, $response, $args)
    {
        $response = $response->withHeader('Access-Control-Allow-Origin', '*');
        $response = $response->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');
        $response = $response->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        $departmentData = $this->departmentService->getDepartmentById($args['id']);
        $response->getBody()->write(json_encode($departmentData));
        return $response->withHeader('Content-Type', 'application/json');
    }
}