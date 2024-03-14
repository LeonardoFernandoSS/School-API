<?php

namespace App\Http\Controllers\Api;

use App\Enums\AbilityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\SearchRequest;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\RoleResource;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    public function __construct(private RoleService $roleService)
    {
        $this->middleware('ability:' . AbilityEnum::ROLE);
        $this->middleware('ability:' . AbilityEnum::ROLE_MANAGE)->except(['index', 'show']);
    }

    public function index(SearchRequest $request): JsonResponse
    {
        $perPage    = $request->query('per_page', 10);
        $page       = $request->query('page', 1);
        $search     = $request->validated();

        $roles = $this->roleService->getPaginate($perPage, $page, $search);

        $resource = new PaginateResource($roles, RoleResource::class);

        return response()->json($resource, Response::HTTP_OK);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $role = $this->roleService->createRole($data);

        $route = route('role.show', ['role' => $role->id]);
        $headers = ["Location" => $route];

        return response()->json('Successfully created', Response::HTTP_CREATED, $headers);
    }

    public function show(string $id): JsonResponse
    {
        $role = $this->roleService->findRole($id);

        $resource = new RoleResource($role);

        return response()->json($resource, Response::HTTP_OK);
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $role = $this->roleService->findRole($id);

        $data = $request->validated();

        $this->roleService->updateRole($role, $data);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    public function destroy(string $id): JsonResponse
    {
        $role = $this->roleService->findRole($id);

        $this->roleService->deleteRole($role);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
