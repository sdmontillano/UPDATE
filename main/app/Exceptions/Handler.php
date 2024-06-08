<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    // Other methods and properties...

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->json(['error' => 'Route not found'], 404);
        } elseif ($exception instanceof ModelNotFoundException) {
            return response()->json(['error' => 'Resource not found'], 404);
        } elseif ($exception instanceof ValidationException) {
            return response()->json(['error' => $exception->getMessage()], 422);
        } elseif ($exception instanceof AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } elseif ($exception instanceof HttpException) {
            return response()->json(['error' => 'HTTP Exception'], $exception->getStatusCode());
        } elseif ($exception instanceof MissingFieldException) {
            return response()->json(['error' => 'Required field is missing: ' . $exception->getMessage()], 400);
        } elseif ($exception instanceof InvalidInputException) {
            return response()->json(['error' => 'Invalid input: ' . $exception->getMessage()], 400);
        } else {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
