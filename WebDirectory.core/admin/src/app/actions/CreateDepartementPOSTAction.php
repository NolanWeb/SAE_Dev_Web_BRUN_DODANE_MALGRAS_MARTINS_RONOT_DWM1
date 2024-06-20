<?php
namespace WebDirectory\admin\app\actions;

use WebDirectory\admin\core\services\annuaire\AnnuaireService;
use Slim\Views\Twig;

class CreateDepartementPOSTAction extends Action
{
    private AnnuaireService $service;
    public function __construct()
    {
        $this->service = new AnnuaireService();
    }
    public function __invoke($request, $response, $args)
    {
        if (!isset($_SESSION['auth'])) {
            return $response->withHeader('Location', '/auth')->withStatus(302);
        }
        $body = $request->getParsedBody();
        $this->service->createDepartement(
            [
                'name' => $body['name'],
                'stage' => $body['stage'],
                'description' => $body['description'],
            ]
        );

        return $response->withHeader('Location', '/listEntries')->withStatus(302);
    }
}