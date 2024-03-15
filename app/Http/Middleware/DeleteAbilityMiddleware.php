<?php

namespace App\Http\Middleware;

use App\Services\AbilityService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DeleteAbilityMiddleware
{
    public function __construct(private AbilityService $abilityService) {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ability_id = $request->route('ability');

        $ability = $this->abilityService->findAbility($ability_id);

        Gate::authorize('deleteAbility', $ability);

        return $next($request);
    }
}
