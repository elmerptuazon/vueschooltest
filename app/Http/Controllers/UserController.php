<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService\UserUpdateService;

class UserController extends Controller
{
    protected $userUpdateService;

    public function __construct(UserUpdateService $userUpdateService)
    {
        $this->userUpdateService = $userUpdateService;
    }

    public function update(Request $request)
    {
        $changes = $request->input('changes');

        $this->userUpdateService->updateUsers($changes);

        return response()->json(['message' => 'Users updated successfully']);
    }
}
