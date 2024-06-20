<?php
namespace WebDirectory\admin\app\actions;

use WebDirectory\admin\core\services\annuaire\AnnuaireService;
use Slim\Views\Twig;

class CreateEntryPOSTAction extends Action
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
        $uploadedFiles = $request->getUploadedFiles();

        if (!isset($uploadedFiles['pp'])) {
            throw new \Exception('No file uploaded with key "pp".');
        }

        if ($uploadedFiles['pp']->getError() === UPLOAD_ERR_INI_SIZE) {
            throw new \Exception('Uploaded file exceeds the upload_max_filesize directive in php.ini.');
        }

        $this->service->createEntry(
            [
                'firstName' => $body['firstName'],
                'lastName' => $body['lastName'],
                'email' => $body['email'],
                'phone' => $body['phone'],
                'address' => $body['address'],
                'department' => $body['department'],
                'description' => $body['description'],
                'pp' => $uploadedFiles['pp']
            ]
        );

        return $response->withHeader('Location', '/listEntries')->withStatus(302);
    }
}