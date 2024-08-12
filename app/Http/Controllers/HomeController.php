<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\History;
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
        $history = History::query()->with('car')->paginate(10);
        return view('history',[
            'history' => $history
        ]);
    }
    public function data(): View|Factory|Application
    {
        $cars = Cars::query()->where('status',1)->paginate(10);

        return view('data',[
            'cars'=>$cars,
        ]);
    }
}
