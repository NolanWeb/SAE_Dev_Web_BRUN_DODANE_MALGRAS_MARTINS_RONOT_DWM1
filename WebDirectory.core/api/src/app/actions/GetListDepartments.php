<?php

namespace WebDirectory\api\app\actions;

use WebDirectory\api\core\services\annuaire\AnnuaireService;

class GetListDepartments extends Action
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
        $entriesData = $this->departmentService->getDepartments();
        $response->getBody()->write(json_encode($entriesData));
        return $response->withHeader('Content-Type', 'application/json');
    }
}