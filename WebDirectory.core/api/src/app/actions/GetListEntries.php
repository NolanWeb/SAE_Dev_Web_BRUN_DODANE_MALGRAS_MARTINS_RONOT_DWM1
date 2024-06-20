<?php

namespace WebDirectory\api\app\actions;

use WebDirectory\api\core\services\annuaire\AnnuaireService;

class GetListEntries extends Action
{
    private AnnuaireService $entryService;

    public function __construct()
    {
        $this->entryService = new AnnuaireService();
    }

    public function __invoke($request, $response, $args)
    {
        $response = $response->withHeader('Access-Control-Allow-Origin', '*');
        $response = $response->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');
        $response = $response->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        $entriesData = $this->entryService->getEntries();
        $response->getBody()->write(json_encode($entriesData));
        return $response->withHeader('Content-Type', 'application/json');
    }
}