<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Resources\ApiStatusResource;

class VerifyUserIsSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (
            $request->user()->isFromPlatform() ||
            $request->user()->isSubscribed()
        ) {
            return $next($request);
        }
        return (new ApiStatusResource([
            'message' => 'Subscription required to access this page.',
            'status'  => 422,
        ]))->setStatusCode(422);
    }
}
