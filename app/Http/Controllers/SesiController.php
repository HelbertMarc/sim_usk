<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        return view('home');
    }
    function login(Request $request)
    {
        $request->validate(
            [
                'username' => 'required', //wajib diisi
                'password' => 'required',
            ],
            [
                //pesan yang muncul saat tidak mengisi form
                'username.required' => 'username wajib diisi',
                'password.required' => 'password wajib diisi',
            ]
        );
        //pengecekkan data
        $ceklogin = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (Auth::attempt($ceklogin)) {
            // echo "sukses";
            // exit();
            $user = Auth::user();
            if ($user->level == 'admin') {
                return redirect('/admin');
            } elseif ($user->level == 'gurubk') {
                return redirect('/guru');
                // print "sugses";
            }
        } else {
            //jika gagal
            return redirect('/')
                ->withErrors('username dan password salah')
                ->withInput();
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return Redirect('/');
    }
}
