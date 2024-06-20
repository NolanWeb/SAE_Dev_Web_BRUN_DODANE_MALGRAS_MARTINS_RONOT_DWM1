<?php
namespace WebDirectory\admin\app\actions;

use WebDirectory\admin\core\services\annuaire\AnnuaireService;
use Slim\Views\Twig;

class AuthPOSTAction extends Action
{
    private AnnuaireService $service;
    public function __construct()
    {
        $this->service = new AnnuaireService();
    }
    public function __invoke($request, $response, $args)
    {
        $body = $request->getParsedBody();
        try {
            $this->service->auth(
                [
                    'mail' => $body['mail'],
                    'password' => $body['password'],
                ]
            );
        } catch (\Exception $e) {
            return $response->withHeader('Location', '/auth')->withStatus(302);
        }

        if (isset($_SESSION['auth'])) {
            return $response->withHeader('Location', '/listEntries')->withStatus(302);
        } else {
            return $response->withHeader('Location', '/auth')->withStatus(302);
        }
    }
}