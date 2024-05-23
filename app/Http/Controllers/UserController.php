<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{

    public function getUsers()
    {
        try {
            $users = User::all();
            return view('dashboard', ['users' => $users]);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch users. Please try again.');
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return back()->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete user. Please try again.');
        }
    }


}
