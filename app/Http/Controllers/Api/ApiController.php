<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponse;
use Illuminate\Http\JsonResponse;

/**
 * Base controller for API responses.
 *
 * Provides standardized JSON responses through the ApiResponse trait.
 *
 * @method JsonResponse successResponse(mixed $data = null, ?string $message = null, int $statusCode = 200)
 */
abstract class ApiController extends Controller
{
    use ApiResponse;

    /**
     * Return a success response with data.
     *
     * @param  mixed  $data  The data to include in the response
     * @param  string|null  $message  Optional success message
     * @param  int  $statusCode  HTTP status code (default: 200)
     */
    protected function successResponse(mixed $data = null, ?string $message = null, int $statusCode = 200): JsonResponse
    {
        return $this->success($data, $message, $statusCode);
    }
}
