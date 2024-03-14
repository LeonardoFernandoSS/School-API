<?php

namespace App\Http\Controllers\Api;

use App\Enums\AbilityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleUser\SyncRequest;
use App\Http\Resources\AbilityResource;
use App\Services\RoleUserService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RoleUserController extends Controller
{
    public function __construct(
        private UserService $userService,
        private RoleUserService $roleUserService
    ) {
        $this->middleware('ability:' . AbilityEnum::ROLE);
        $this->middleware('ability:' . AbilityEnum::ROLE_MANAGE);
    }

    public function sync(SyncRequest $request, string $id): JsonResponse
    {
        $user = $this->userService->findUser($id);
        
        $data = $request->validated();
        
        $this->roleUserService->syncRoleUser($user, $data);

        return response()->json('Successfully synchronized', Response::HTTP_NO_CONTENT);
    }

    public function related(string $id): JsonResponse
    {
        $user = $this->userService->findUser($id);

        $roles = $this->roleUserService->relatedRoleUser($user);

        return response()->json(AbilityResource::collection($roles), Response::HTTP_OK);
    }

    public function unrelated(string $id): JsonResponse
    {
        $user = $this->userService->findUser($id);

        $roles = $this->roleUserService->unrelatedRoleUser($user);
        
        return response()->json(AbilityResource::collection($roles), Response::HTTP_OK);
    }
}
