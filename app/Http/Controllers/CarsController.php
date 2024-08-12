<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cars\StoreCars;
use App\Models\Cars;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Services\Cars\StoreService;

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
        Cars::destroy($id);
        return response()->json(['success' => 'Car deleted successfully!']);
    }
}
