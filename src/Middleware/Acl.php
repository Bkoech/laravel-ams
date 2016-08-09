<?php

namespace Wilgucki\LaravelAms\Middleware;

use Closure;
use Illuminate\Http\Request;

class Acl
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        list($controller, $action) = explode('@', $request->route()->getAction()['controller']);

        if (\Gate::denies('access', [$controller, $action])) {
            abort(403, 'ACL mówi NIE!');
        }

        return $response;
    }
}
