<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $user->update($request->all());
        return response()->json(['message' => 'User updated'], 200);
    }

    public function delete(Request $request)
    {
        $request->user()->delete();
        return response()->json(['message' => 'User deleted'], 200);
    }

    public function transactions(Request $request)
    {
        return $request->user()->transactions;
    }
}
