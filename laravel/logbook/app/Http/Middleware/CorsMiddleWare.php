<?php
namespace App\Http\Middleware;

use Closure;

/**
* Class Cors
*
* @package App\Http\Middleware
*/
class CorsMiddleware
{
/**
* Handle an incoming request.
*A
* Please add header('Access-Control-Allow-Origin: http://example.com');
* & header('Access-Control-Allow-Credentials: true');
* at the top of your route file.
*
* @param  \Illuminate\Http\Request $request
* @param  \Closure                 $next
* @return mixed
*/
	public function handle($request, Closure $next)
	{
		header("Access-Control-Allow-Origin: *");
		//header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day

		// ALLOW OPTIONS METHOD
		$headers = [
				'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
				'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
			       ];

	if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }		       

	if ($request->getMethod() == "OPTIONS")
	{
		  // The client-side application can set only headers allowed in Access-Control-Allow-Headers
 	  return Response::make('OK', 200, $headers);
	}

		$response = $next($request);
		foreach ($headers as $key => $value) {
		$response->header($key, $value);
				return $response;
		}
	}
}