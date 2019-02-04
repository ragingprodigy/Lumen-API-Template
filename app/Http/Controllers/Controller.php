<?php

namespace DevProject\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class Controller
 *
 * @package DevProject\Http\Controllers
 */
class Controller extends BaseController
{

    /**
     * @var JWTAuth
     */
    protected $auth;

    /**
     * Controller constructor.
     * @param JWTAuth $auth
     */
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param mixed $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendResponse($message, $code = 200)
    {
        return response()->json([
            'result' => $message,
            'error' => false,
        ], $code);
    }

    /**
     * @param mixed $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendError($message, $code = 200)
    {
        return response()->json([
            'message' => $message,
            'error' => true,
        ], $code);
    }
}
