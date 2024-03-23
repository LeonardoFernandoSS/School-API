<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\DestroyRequest;
use App\Http\Requests\Profile\PasswordRequest;
use App\Http\Requests\Profile\UpdateRequest;
use App\Http\Resources\ProfileResource;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    public function __construct(
        private ProfileService $profileService
    ) {
    }

    public function show(): JsonResponse
    {
        $user = $this->profileService->findProfile();

        return response()->json(new ProfileResource($user), Response::HTTP_OK);
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = $this->profileService->findProfile();

        $this->profileService->updateProfile($user, $data);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    public function password(PasswordRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = $this->profileService->findProfile();

        $this->profileService->updatePassword($user, $data);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    public function destroy(DestroyRequest $request): JsonResponse
    {
        $user = $this->profileService->findProfile();

        $this->profileService->deleteProfile($user);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
