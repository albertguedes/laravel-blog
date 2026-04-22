<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Admin\Roles\StoreRoleRequest;
use App\Http\Requests\Admin\Roles\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

/**
 * Controller for admin role management.
 *
 * Handles CRUD operations for roles with soft delete functionality.
 */
class RolesController extends ApiController
{
    /**
     * Display a paginated listing of roles.
     */
    public function index(): JsonResponse
    {
        $roles = Role::orderBy('title', 'asc')
            ->paginate(15);

        return $this->paginated($roles);
    }

    /**
     * Store a newly created role.
     */
    public function store(StoreRoleRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $role = Role::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return $this->created($role);
    }

    /**
     * Display the specified role with its users.
     */
    public function show(Role $role): JsonResponse
    {
        $role->load('users');

        return $this->success($role);
    }

    /**
     * Update the specified role.
     */
    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        $validated = $request->validated();

        $role->fill($validated);
        $role->save();

        return $this->updated($role);
    }

    /**
     * Soft delete the specified role.
     */
    public function destroy(Role $role): JsonResponse
    {
        $role->delete();

        return $this->deleted();
    }
}
