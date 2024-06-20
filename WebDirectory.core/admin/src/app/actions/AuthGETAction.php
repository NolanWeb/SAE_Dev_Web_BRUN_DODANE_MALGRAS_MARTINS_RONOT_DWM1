<?php
namespace WebDirectory\admin\app\actions;

use WebDirectory\admin\core\services\annuaire\AnnuaireService;
use Slim\Views\Twig;

class AuthGETAction extends Action
{
    private AnnuaireService $service;
    public function __construct()
    {
        $this->service = new AnnuaireService();
    }
    public function __invoke($request, $response, $args)
    {
        $view = Twig::fromRequest($request);
        return $view->render(
            $response,
            'auth.html.twig',
            [
            ]
        );
    }
}