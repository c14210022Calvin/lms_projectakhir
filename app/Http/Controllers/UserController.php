<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all(); // Ambil semua data pengguna
        return view('users.index', compact('users'));
    }
}
