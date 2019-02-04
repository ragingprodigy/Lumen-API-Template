<?php

/** @var \Laravel\Lumen\Routing\Router $router */

if (!defined('__HOST__')) {
    define('__HOST__', env('APP_URL') . '/api');
}

$version = file_get_contents(base_path('VERSION'));
$version = is_bool($version) ? 0 : trim($version);

if (!defined('__VERSION__')) {
    define('__VERSION__', $version);
}

/**
 * @OA\Info(
 *    title="DevProject Digital Marketing API",
 *    description="This is the DevProject Digital Marketing API",
 *    version=__VERSION__,
 *    @OA\License(
 *        name="proprietary",
 *    ),
 *    @OA\Contact(
 *        email="o.omonayajo@gmail.com"
 *    )
 * ),
 * @OA\Server(
 *     url=__HOST__
 * )
 *
 * @OA\Response(
 *   response="todo",
 *   description="This API call has no documented response (yet)",
 * )
 *
 * @OA\Response(
 *   response=409,
 *   description="Unauthorized",
 * )
 *
 * @OA\SecurityScheme(
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="api_key",
 *     name="Authorization"
 * )
 */
$router->get('/', function () use ($router, $version) {
    return response()->json([
        'framework' => $router->app->version(),
        'apiRoutes' => [
            'version'       => $version,
            'api'           => url('api'),
            'documentation' => url('api/documentation'),
        ],
    ]);
});

$router->group(['prefix' => 'api'], function () use ($router, $version) {

    /**
     * @OA\Get(
     *     path="/",
     *     summary="Get API Info",
     *     operationId="getInfo",
     *     @OA\Response(
     *         response=200,
     *         description="JSON Object describing API"
     *     ),
     * )
     */
    $router->get('', function () use ($version) {
        return response()->json([
            'apiVersion'    => $version,
            'author'        => 'Oladapo Omonayajo',
            'support'       => 'o.omonayajo@gmail.com',
        ]);
    });

    /**
     * @OA\Get(
     *     path="/documentation",
     *     tags={"documentation"},
     *     summary="Get API Documentation",
     *     operationId="getDocs",
     *     @OA\Response(
     *         response=200,
     *         description="Full JSON documentation"
     *     ),
     * )
     */
    $router->get('documentation', function () {
        return response(\OpenApi\scan(base_path('app')));
    });

    $router->post('authenticate', 'Auth@login');

    $router->group(['middleware' => 'auth', 'prefix' => 'user'], function () use ($router) {
        $router->get('me', 'Auth@me');
        $router->get('refresh', 'Auth@refresh');
        $router->post('logout', 'Auth@logout');
    });
});
