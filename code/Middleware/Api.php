<?php

namespace Lex\Middleware;

use Closure;

class Api
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	public function handle($request, Closure $next)
	{
		$request->headers->set('Accept', 'application/json');
		$request->headers->set('Content-Type', 'application/json');
		return $next($request);
	}
}