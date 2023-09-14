<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //
    public function logout(Request $request)
    {
        dd(Auth()->role_id);
        Auth::logout();

        // Redirect to a specific page after logout (e.g., the home page)
        return redirect('/login');
    }
}
