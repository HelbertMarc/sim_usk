<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // echo 'Selamat datang';
        // echo '<h1>'. Auth::user()->nama .'</h1>';
        // echo "<br><a href='logout'>logout</a>";
        return view('admin.index');
    }
}
