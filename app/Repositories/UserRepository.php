<?php

namespace App\Repositories;

use App\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserRepository
{
    private $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function updateAPIToken()
    {
        $user = Auth::user();
        $user->api_token = Str::random(80);
        $user->save();
    }
}