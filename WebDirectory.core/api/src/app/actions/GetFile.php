<?php

namespace WebDirectory\api\app\actions;

class GetFile extends Action
{
    public function __invoke($request, $response, $args)
    {
        $response = $response->withHeader('Access-Control-Allow-Origin', '*');
        $response = $response->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');
        $response = $response->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        $file = $args['file'];
        $path = __DIR__ . '/../../files/' . $file . '.png';
        if (file_exists($path)) {
            $response->getBody()->write(file_get_contents($path));
            return $response->withHeader('Content-Type', 'image/png');
        } else {
            return $response->withStatus(404);
        }
    }
}