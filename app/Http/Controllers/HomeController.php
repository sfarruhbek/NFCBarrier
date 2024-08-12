<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function index(): View|Factory|Application
    {
        return view('index');
    }
    public function history(): View|Factory|Application
    {
        return view('history');
    }
    public function data(): View|Factory|Application
    {
        return view('data',[
            'cars'=>Cars::all(),
        ]);
    }
}
