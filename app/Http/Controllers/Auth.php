<?php
declare(strict_types=1);

/**
 * Created by: dapo <o.omonayajo@gmail.com>
 * Created on: 29/01/2019, 4:16 PM
 */

namespace DevProject\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use DevProject\Eloquent\Models\User;

/**
 * Class Auth
 *
 * @package DevProject\Http\Controllers
 */
class Auth extends Controller
{

    /**
     * @OA\Schema(
     *     schema="LoginParams",
     *     title="Login Payload",
     *     @OA\Property(
     *         property="username",
     *         type="string",
     *     ),
     *     @OA\Property(
     *         property="password",
     *         type="string",
     *     ),
     * )
     *
     * @OA\Schema(
     *     schema="TokenResponse",
     *     title="Auth Response",
     *     @OA\Property(
     *         property="token",
     *         type="string",
     *     ),
     *     @OA\Property(
     *         property="token_type",
     *         type="string",
     *     ),
     *     @OA\Property(
     *         property="expires_in",
     *         type="number",
     *     ),
     * )
     *
     * @OA\Post(
     *     path="/authenticate",
     *     tags={"authentication"},
     *     summary="Get Authentication Token",
     *     operationId="authenticate",
     *     @OA\RequestBody(
     *         description="Login Credentials",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginParams")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Header(
     *             header="X-Rate-Limit",
     *             description="calls per hour allowed by the user",
     *             @OA\Schema(
     *                 type="integer",
     *                 format="int32"
     *             )
     *         ),
     *         @OA\Header(
     *             header="X-Expires-After",
     *             description="date in UTC when token expires",
     *             @OA\Schema(
     *                 type="string",
     *                 format="datetime"
     *             )
     *         ),
     *         @OA\JsonContent(ref="#/components/schemas/TokenResponse")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid username or password."
     *     )
     * )
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $rules = [
            'username' => 'string|required|min:4',
            'password' => 'string|required|min:4',
        ];

        $payload = $this->validate($request, $rules);

        if (!$token = $this->auth->attempt($payload)) {
            return response()->json(['error' => 'Invalid Username or Password'], 401);
        }

        /** @var User $user */
        $user = $this->auth->user();
        $user->setLastLogin(Carbon::now())->setLastLoginFrom($request->getClientIp())->save();

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Get(
     *     path="/user/me",
     *     tags={"profile","user"},
     *     summary="Get Authentication Token",
     *     operationId="getProfile",
     *     security="Authorization",
     *     @OA\Response(
     *         response=200,
     *         description="Current user profile",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(response="409", ref="#/components/responses/409")
     * )
     * @return JsonResponse
     */
    public function me()
    {
        return $this->sendResponse($this->auth->user());
    }

    /**
     * @OA\Get(
     *     path="/user/refresh",
     *     tags={"user"},
     *     summary="Refresh Authentication Token",
     *     operationId="refreshToken",
     *     security="Authorization",
     *     @OA\Response(
     *         response=200,
     *         description="Updated Token",
     *         @OA\JsonContent(ref="#/components/schemas/TokenResponse")
     *     ),
     *     @OA\Response(response="409", ref="#/components/responses/409")
     * )
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->auth->refresh());
    }

    /**
     * @OA\Post(
     *     path="/user/logout",
     *     tags={"user"},
     *     summary="Invalidate Authentication Token",
     *     operationId="invalidateToken",
     *     security="Authorization",
     *     @OA\Response(
     *         response=200,
     *         description="Logout Successful",
     *     ),
     *     @OA\Response(response="409", ref="#/components/responses/409")
     * )
     * @return JsonResponse
     * @throws \Tymon\JWTAuth\Exceptions\JWTException
     */
    public function logout()
    {
        $this->auth->parseToken();
        $this->auth->invalidate(true);
        return $this->sendResponse('Logout Successful');
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return $this->sendResponse([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->auth->factory()->getTTL() * 60
        ]);
    }
}
