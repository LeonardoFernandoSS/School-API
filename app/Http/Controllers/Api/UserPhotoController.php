<?php

namespace App\Http\Controllers\Api;

use App\Enums\AbilityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Photo\UploadRequest;
use App\Services\UserPhotoService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserPhotoController extends Controller
{
    public function __construct(private UserService $userService, private UserPhotoService $userPhotoService)
    {
        $this->middleware('ability:' . AbilityEnum::USER_MANAGE);
    }

    public function upload(UploadRequest $request, int $user_id): JsonResponse
    {
        $photo = $request->file('photo');

        $user = $this->userService->findUser($user_id);

        $user = $this->userPhotoService->uploadUserPhoto($user, $photo);

        $headers = ["Location" => $user->photo_url];

        return response()->json('Successfully uploaded', Response::HTTP_OK, $headers);
    }

    public function delete(string $id): JsonResponse
    {
        $user = $this->userService->findUser($id);

        $this->userPhotoService->deleteUserPhoto($user);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
