<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;

class UserRegistration extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param UserFormRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(UserFormRequest $request)
    {
        $users = User::all();

        $user = User::create($request->all());

        if ($users->count() > 0) {
            $users->each(function ($oldUser) use ($user) {
                $oldUser->follow($user);
                $user->follow($oldUser);
            });
        }

        return response()->json($user, 201);
    }
}
