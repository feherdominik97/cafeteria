<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCafeteriaRequest;
use App\Http\Requests\UpdateCafeteriaRequest;
use App\Models\Cafeteria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
    public function store(Request $request): Model|Builder
    {
        return Cafeteria::query()->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($month): array
    {
        return Cafeteria::query()->where(compact('month'))->get()->toArray();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $month): int
    {
        return Cafeteria::query()->where(compact('month'))->update($request->all());
    }

    private function getAllAmount($is_update)
    {
        $sent_amount = request()->input('amount', 0);
        $cafeterias = $this->index();
        $year_summary = 0;
        foreach ($cafeterias as $cafeteria)
            $year_summary += ($cafeteria['month'] === request()->input('month', '') ? $sent_amount : $cafeteria['amount']);

        return $year_summary + ($is_update ? 0 : $sent_amount);
    }

    private function getAmountForPocket($is_update)
    {
        $sent_amount = request()->input('amount', 0);
        $all_cafeterias_on_pocket = Cafeteria::query()->where('pocket', request()->input('pocket', ''))->get()->toArray();
        $pocket_summary = 0;
        foreach ($all_cafeterias_on_pocket as $cafeteria)
            $pocket_summary += ($is_update && $cafeteria['pocket'] === request()->input('pocket', '') ? $sent_amount : $cafeteria['amount']);

        return $pocket_summary + ($is_update ? 0 : $sent_amount);
    }

    public function save(Request $request): Model|Builder|int|string
    {
        $month = $request->input('month', '');
        $is_update = $this->show($month);

        if($this->getAllAmount($is_update) > 400000)
            return 'The cafeteria is more than the allowed in a year.';

        if($this->getAmountForPocket($is_update) > 200000)
            return 'The cafeteria is more than the allowed in a year for this pocket.';

        return $is_update ? $this->update($request, $month) : $this->store($request);
    }
}
