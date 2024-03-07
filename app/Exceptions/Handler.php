<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthenticationException) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof UnauthorizedHttpException || $exception instanceof AuthorizationException) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }

        if ($exception instanceof MissingAbilityException) {
            return response()->json(['message' => 'Missing ability'], Response::HTTP_FORBIDDEN);
        }

        if ($exception instanceof ValidationException) {
            return response()->json(["errors" => $exception->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        echo $exception; // TODO: Apenas dev

        // return response()->json(['message' => 'Internal server erro'], Response::HTTP_INTERNAL_SERVER_ERROR); // TODO: Apenas prod
    }
}
