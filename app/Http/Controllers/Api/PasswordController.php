<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Password\RememberRequest;
use App\Http\Requests\Password\ResetRequest;
use App\Services\PasswordService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PasswordController extends Controller
{
    public function __construct(private PasswordService $passwordService)
    {
    }

    public function remember(RememberRequest $request): JsonResponse
    {
        $data = $request->validated();

        $this->passwordService->rememberPassword(...$data);

        return response()->json('E-mail sent', Response::HTTP_OK);
    }

    public function reset(ResetRequest $request): JsonResponse
    {
        $data = $request->validated();

        $this->passwordService->resetPassword(...$data);
        
        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
