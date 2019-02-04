<?php
declare(strict_types = 1);

/**
 * @author Oladapo Omonayajo <oladapo.omonayajo@lazada.com.ph>
 * Created on 3/27/2017, 18:21
 */

namespace DevProject\Http\Middleware;

/**
 * Class CorsMiddleware
 *
 * @package App\Http\Middleware
 */
class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $origin = $request->header('origin');
        $headers = [
            'Access-Control-Allow-Origin'       => $origin,
            'Access-Control-Allow-Credentials'  => 'true',
            'API-VERSION'                       => file_get_contents(base_path('VERSION')),
        ];

        if ($request->isMethod('OPTIONS')) {
            return response()->json(['method' => 'OPTIONS' ], 204, $headers);
        }

        $response = $next($request);
        foreach ($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}
