<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Admin\Users\StoreUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends ApiController
{
    public function index(): JsonResponse
    {
        $users = User::with('profile', 'roles')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return $this->paginated($users);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'is_active' => $validated['is_active'] ?? true,
                'is_admin' => $validated['is_admin'] ?? false,
            ]);

            Profile::create([
                'user_id' => $user->id,
                'name' => $validated['name'],
                'username' => $validated['username'],
                'about' => $validated['about'] ?? null,
            ]);

            return $user;
        });

        $user->load('profile', 'roles');

        return $this->created($user);
    }

    public function show(User $user): JsonResponse
    {
        $user->load('profile', 'roles');

        return $this->success($user);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $user) {
            if (isset($validated['email'])) {
                $user->email = $validated['email'];
            }

            if (isset($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            if (isset($validated['is_active'])) {
                $user->is_active = $validated['is_active'];
            }

            if (isset($validated['is_admin'])) {
                $user->is_admin = $validated['is_admin'];
            }

            $user->save();

            if (isset($validated['name']) || isset($validated['username']) || isset($validated['about'])) {
                $user->profile->fill([
                    'name' => $validated['name'] ?? $user->profile->name,
                    'username' => $validated['username'] ?? $user->profile->username,
                    'about' => $validated['about'] ?? $user->profile->about,
                ])->save();
            }
        });

        $user->load('profile', 'roles');

        return $this->updated($user);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return $this->deleted();
    }
}
