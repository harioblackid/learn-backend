<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use App\Http\Resources\UserResources;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(UserRegistrationRequest $req): JsonResponse {
        $data = $req->validated();
        if(User::where("username", $data["username"])->count() == 1) {
            throw new HttpResponseException(response()
                ->json([
                    "error"=> [
                        "username"=> [
                            "Username already exists"
                        ]
                    ]
                ], 400));
        }

        $user = new User($data);
        $user->password = Hash::make($data['password']);
        $user->save();

        return (new UserResources($user))->response()->setStatusCode(201);
    }

}
