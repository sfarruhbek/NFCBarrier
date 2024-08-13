<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cars\StoreCars;
use App\Models\Cars;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Services\Cars\StoreService;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function __construct(protected StoreService $car){
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCars $request): RedirectResponse
    {
        $this->car->store($request->validated());

        return back()->with('success', 'Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cars $cars)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cars $cars)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCars $request, $id)
    {
        $cars = Cars::find($id);
        $this->car->update($request->validated(), $cars);

        return back()->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $data=Cars::find($id);
        $data->status=false;
        $data->save();
        return response()->json(['success' => 'Car deleted successfully!']);
    }
    public function check(Request $request)
    {
        $data = Cars::where('car_number', $request->car_number)->first();
        if (!$data) {
            return response(['success' => 'Car deleted successfully!']);
        }
        return dd($data);
    }
    public function card(Request $request)
    {
        $data = Cars::where('card', $request->card)->first();
        if (!$data) {
            return response(['success' => 'Car deleted successfully!']);
        }
        return dd($data);
    }
    public function card_update(Request $request)
    {
        $data = Cars::where('card', $request->card)->first();
        if ($data) {
            dd("ss");
        }
        $data = Cars::find($request->id);
        $data->card = $request->card;
        $data->save();
        return response(['success' => 'Car deleted successfully!']);
    }
}
