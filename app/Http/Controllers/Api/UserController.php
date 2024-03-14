<?php

namespace App\Http\Controllers\Api;

use App\Enums\AbilityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\SearchRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\UserDetailResource;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
        $this->middleware('ability:' . AbilityEnum::USER);
        $this->middleware('ability:' . AbilityEnum::USER_MANAGE)->except(['index', 'show']);
        $this->middleware('ability:' . AbilityEnum::USER_DETAIL)->only('show');
    }

    public function index(SearchRequest $request): JsonResponse
    {
        $perPage    = $request->query('per_page', 10);
        $page       = $request->query('page', 1);
        $search     = $request->validated();

        $users = $this->userService->getPaginate($perPage, $page, $search);

        $resource = new PaginateResource($users, UserResource::class);

        return response()->json($resource, Response::HTTP_OK);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = $this->userService->createUser($data);

        $route = route('user.show', ['user' => $user->id]);
        $headers = ["Location" => $route];

        return response()->json('Successfully created', Response::HTTP_CREATED, $headers);
    }

    public function show(string $id): JsonResponse
    {
        $user = $this->userService->findUser($id);

        $resource = new UserDetailResource($user);

        return response()->json($resource, Response::HTTP_OK);
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $user = $this->userService->findUser($id);

        $data = $request->validated();

        $this->userService->updateUser($user, $data);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    public function destroy(string $id): JsonResponse
    {
        $user = $this->userService->findUser($id);

        $this->userService->deleteUser($user);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
