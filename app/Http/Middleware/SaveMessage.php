<?php

namespace App\Http\Middleware;

use App\Jobs\SaveMessageJob;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class SaveMessage
{
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        $user = $request->get('user');

        if ($user->isAdmin() || $user->id == 6752) {
            return $next($request);
        }

        $update = json_decode($request->getContent(), true);

        SaveMessageJob::dispatchSync($user, $update);

        return $next($request);
    }
}
