<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all movies
        $movies = Movie::all();
        return view('admindash', compact('movies'));
    }

    public function manageUsers()
    {
        // Fetch users with their bookings and related movies
        $users = User::with('bookings.movie')->get();
        Log::info('Fetched users with bookings', ['users' => $users->toArray()]);
        return view('admin.manage-users', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.manage-users')->with('success', 'User deleted successfully.');
    }
}
