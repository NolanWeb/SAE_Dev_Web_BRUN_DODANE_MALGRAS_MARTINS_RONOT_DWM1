<?php

namespace WebDirectory\api\app\actions;

use WebDirectory\api\core\services\annuaire\AnnuaireService;
use WebDirectory\core\services\annuaire\AnnuaireServiceExceptionNotFound;

class GetEntryById extends Action
{
    private AnnuaireService $entryService;

    public function __construct()
    {
        $this->entryService = new AnnuaireService();
    }

    /**
     * @throws AnnuaireServiceExceptionNotFound
     */
    public function __invoke($request, $response, $args)
    {
        $response = $response->withHeader('Access-Control-Allow-Origin', '*');
        $response = $response->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');
        $response = $response->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        $entryData = $this->entryService->getEntryById($args['id']);
        $response->getBody()->write(json_encode($entryData));
        return $response->withHeader('Content-Type', 'application/json');
    }
}