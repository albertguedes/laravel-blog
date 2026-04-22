<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponse;
use Illuminate\Http\JsonResponse;

abstract class ApiController extends Controller
{
    use ApiResponse;

    /**
     * Return a success response with data.
     */
    protected function successResponse(mixed $data = null, ?string $message = null, int $statusCode = 200): JsonResponse
    {
        return $this->success($data, $message, $statusCode);
    }
}
