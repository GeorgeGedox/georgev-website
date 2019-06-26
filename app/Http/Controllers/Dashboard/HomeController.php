<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->redirectTo = route('dashboard.index');
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.home.index');
    }
}
