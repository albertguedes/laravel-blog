<?php

declare(strict_types=1);

namespace App\Traits\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Provides standardized JSON API response methods.
 *
 * @mixin ApiController
 */
trait ApiResponse
{
    /**
     * Return a success response with data.
     *
     * @param  mixed  $data  The data to include in the response
     * @param  string|null  $message  Optional success message
     * @param  int  $statusCode  HTTP status code (default: 200)
     */
    protected function success(mixed $data = null, ?string $message = null, int $statusCode = 200): JsonResponse
    {
        $response = [];

        if ($data instanceof ResourceCollection) {
            $response['data'] = $data->response()->getData(true)['data'] ?? $data->collection->toArray();
        } elseif ($data instanceof JsonResource) {
            $response['data'] = $data->toArray(request());
        } elseif ($data instanceof Model) {
            $response['data'] = (new JsonResource($data))->toArray(request());
        } elseif (is_array($data)) {
            $response['data'] = $data;
        } else {
            $response['data'] = $data;
        }

        if ($message) {
            $response['message'] = $message;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Return a paginated success response.
     *
     * @param  LengthAwarePaginator  $paginator  The paginated data
     * @param  string|null  $message  Optional success message
     */
    protected function paginated(LengthAwarePaginator $paginator, ?string $message = null): JsonResponse
    {
        $data = ResourceCollection::make($paginator->items())->toArray(request());

        $response = [
            'data' => $data,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
            ],
        ];

        if ($message) {
            $response['message'] = $message;
        }

        return response()->json($response);
    }

    /**
     * Return a created response (HTTP 201).
     *
     * @param  mixed  $data  The created resource data
     * @param  string|null  $message  Optional success message
     */
    protected function created(mixed $data = null, ?string $message = 'Resource created successfully.'): JsonResponse
    {
        return $this->success($data, $message, 201);
    }

    /**
     * Return an updated response (HTTP 200).
     *
     * @param  mixed  $data  The updated resource data
     * @param  string|null  $message  Optional success message
     */
    protected function updated(mixed $data = null, ?string $message = 'Resource updated successfully.'): JsonResponse
    {
        return $this->success($data, $message);
    }

    /**
     * Return a deleted response (HTTP 200).
     *
     * @param  string|null  $message  Optional success message
     */
    protected function deleted(?string $message = 'Resource deleted successfully.'): JsonResponse
    {
        return response()->json(['message' => $message]);
    }

    /**
     * Return an error response.
     *
     * @param  string  $message  The error message
     * @param  int  $statusCode  HTTP status code (default: 400)
     * @param  array  $errors  Optional validation errors array
     */
    protected function error(string $message, int $statusCode = 400, array $errors = []): JsonResponse
    {
        $response = ['message' => $message];

        if (! empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Return a not found error response (HTTP 404).
     *
     * @param  string  $message  The error message
     */
    protected function notFound(string $message = 'Resource not found.'): JsonResponse
    {
        return $this->error($message, 404);
    }

    /**
     * Return a validation error response (HTTP 422).
     *
     * @param  array  $errors  The validation errors
     * @param  string  $message  The error message
     */
    protected function validationError(array $errors, string $message = 'Validation failed.'): JsonResponse
    {
        return $this->error($message, 422, $errors);
    }
}
