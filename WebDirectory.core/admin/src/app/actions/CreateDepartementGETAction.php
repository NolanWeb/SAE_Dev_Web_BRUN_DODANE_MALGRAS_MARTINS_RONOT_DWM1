<?php

namespace WebDirectory\admin\app\actions;

use Slim\Views\Twig;
use WebDirectory\admin\core\services\annuaire\AnnuaireService;

class CreateDepartementGETAction extends Action
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
        $departments = $this->service->getDepartments();
        $view = Twig::fromRequest($request);
        return $view->render(
            $response,
            'createDepartement.html.twig',
            [
                'departments' => $departments
            ]
        );
    }
}
