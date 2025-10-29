<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(): View
    {



        
        return view('dashboard');
    }
}


















?>