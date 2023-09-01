<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)

    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],


        ]);

        $save=User::create([
            'name' => ($request->name),
            'email' => ($request->email),
            'password' => Hash::make($request->password),
            'role_id' => 2
        ]);



        if ($save) {
            Alert::success('success', 'Akun sudah terdaftar !');
        } else {
            Alert::error('Failed', 'Registrasi gagal !');
        }

        return redirect('/');
    }
}
