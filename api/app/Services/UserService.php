<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Redis;
class UserService
{
    public function all()
    {
        $users_data = Redis::get('users_data');
        if(isset($users_data)) {
            $users = json_decode($users_data);
        } else {
            $users = User::with('weather')->get();
            Redis::set('users_data', $users, 'EX', 1800);
        }

        return $users;
    }
}