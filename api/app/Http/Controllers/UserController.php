<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UserController extends Controller
{
    public function index(UserService $userService) 
    {
        return response()->json([
            'All systems are a go', 
            'users' => $userService->all()
        ]);
    }
}
