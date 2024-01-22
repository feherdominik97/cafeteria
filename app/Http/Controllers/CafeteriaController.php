<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCafeteriaRequest;
use App\Http\Requests\UpdateCafeteriaRequest;
use App\Models\Cafeteria;
use Illuminate\Http\Request;

class CafeteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cafeteria::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Cafeteria::query()->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($month)
    {
        return Cafeteria::query()->where(compact('month'))->get()->toArray();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $month)
    {
        Cafeteria::query()->where(compact('month'))->update($request->all());
    }

    public function save(Request $request)
    {
        $month = $request->input('month');
        if($this->show($month))
            $this->update($request, $month);
        else
            $this->store($request);
    }
}
