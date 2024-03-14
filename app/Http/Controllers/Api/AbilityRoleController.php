<?php

namespace App\Http\Controllers\Api;

use App\Enums\AbilityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AbilityRole\SyncRequest;
use App\Http\Resources\AbilityResource;
use App\Services\AbilityRoleService;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AbilityRoleController extends Controller
{
    public function __construct(
        private RoleService $roleService,
        private AbilityRoleService $abilityRoleService
    ) {
        $this->middleware('ability:' . AbilityEnum::ROLE);
        $this->middleware('ability:' . AbilityEnum::ROLE_MANAGE);
    }

    public function sync(SyncRequest $request, string $id): JsonResponse
    {
        $role =$this->roleService->findRole($id);
        
        $data = $request->validated();
        
        $this->abilityRoleService->syncAbilityRole($role, $data);

        return response()->json('Successfully synchronized', Response::HTTP_NO_CONTENT);
    }

    public function related(string $id): JsonResponse
    {
        $role =$this->roleService->findRole($id);

        $abilities = $this->abilityRoleService->relatedAbilityRole($role);

        return response()->json(AbilityResource::collection($abilities), Response::HTTP_OK);
    }

    public function unrelated(string $id): JsonResponse
    {
        $role =$this->roleService->findRole($id);

        $abilities = $this->abilityRoleService->unrelatedAbilityRole($role);
        
        return response()->json(AbilityResource::collection($abilities), Response::HTTP_OK);
    }
}
