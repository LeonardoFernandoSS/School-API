<?php

namespace App\Http\Controllers\Api;

use App\Enums\AbilityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ability\SearchRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\AbilityResource;
use App\Services\AbilityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AbilityController extends Controller
{
    public function __construct(private AbilityService $abilityService)
    {
        $this->middleware('ability:' . AbilityEnum::ABILITY);
    }

    public function index(SearchRequest $request): JsonResponse
    {
        $perPage    = $request->query('per_page', 10);
        $page       = $request->query('page', 1);
        $search     = $request->validated();

        $abilities = $this->abilityService->getPaginate($perPage, $page, $search);

        $resource = new PaginateResource($abilities, AbilityResource::class);

        return response()->json($resource, Response::HTTP_OK);
    }
}
