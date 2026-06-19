<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // ======================================================
    // === List semua user
    // ======================================================
    public function index()
    {
        $users = User::with(['role', 'department'])->get();

        return response()->json([
            'status' => 'success',
            'data' => $users
        ]);
    }

    // ======================================================
    // === Show single user
    // ======================================================
        public function show($id)
        {
            $user = User::with(['role', 'department'])->find($id);

            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
            }

            return response()->json(['status' => 'success', 'data' => $user]);
        }

    // ======================================================
    // === Create new user
    // ======================================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'id_role' => ['required', Rule::exists('role', 'id_role')],
            'id_department' => ['required', Rule::exists('department', 'id_department')],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => $user
        ], 201);
    }

    // ======================================================
    // === Update user
    // ======================================================
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => ['sometimes','required','email', Rule::unique('users','email')->ignore($user->id)],
            'password' => 'sometimes|nullable|string|min:6',
            'id_role' => ['sometimes','required', Rule::exists('role', 'id_role')],
            'id_department' => ['sometimes','required', Rule::exists('department', 'id_department')],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'data' => $user
        ]);
    }

    // ======================================================
    // === Delete user
    // ======================================================
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully'
        ]);
    }
}