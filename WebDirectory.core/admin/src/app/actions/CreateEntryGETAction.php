<?php
namespace WebDirectory\admin\app\actions;

use WebDirectory\admin\core\services\annuaire\AnnuaireService;
use Slim\Views\Twig;

class CreateEntryGETAction extends Action
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
        $entryData = $this->service->getEntries();
        $departments = $this->service->getDepartments();
        $view = Twig::fromRequest($request);
        return $view->render(
            $response,
            'createEntry.html.twig',
            [
                'listes' => $entryData,
                'departments' => $departments
            ]
        );
    }
}