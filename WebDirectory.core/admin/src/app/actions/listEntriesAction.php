<?php
namespace WebDirectory\admin\app\actions;

use WebDirectory\admin\core\services\annuaire\AnnuaireService;
use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDirectory\admin\core\services\annuaire\AnnuaireServiceExceptionNotFound;

class listEntriesAction extends Action
{
    private AnnuaireService $service;

    public function __construct()
    {
        $this->service = new AnnuaireService();
    }

    public function __invoke($request, $response, $args)
    {
        $queryParams = $request->getQueryParams();
        $departmentId = $queryParams['department'] ?? null;

        try {
            if ($departmentId) {
                $entryData = $this->service->getEntriesByDepartment($departmentId);
            } else {
                $entryData = $this->service->getEntries();
            }

            $departments = $this->service->getDepartments();
            $view = Twig::fromRequest($request);
            return $view->render(
                $response,
                'listEntries.html.twig',
                [
                    'entries' => $entryData,
                    'departments' => $departments,
                    'selectedDepartment' => $departmentId,
                ]
            );
        } catch (AnnuaireServiceExceptionNotFound $e) {
            // Gérer l'exception et afficher un message d'erreur
            $response->getBody()->write('Erreur : ' . $e->getMessage());
            return $response->withStatus(404);
        }
    }
}


