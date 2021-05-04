<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ChartController extends Controller
{
    public function showChart()
    {
        $population = User::select(
                        \DB::raw("year(created_at) as year"),
                        \DB::raw("SUM(name) as names"),
                        \DB::raw("SUM(email) as emails"))
                    ->orderBy(\DB::raw("YEAR(created_at)"))
                    ->groupBy(\DB::raw("YEAR(created_at)"))
                    ->get();

        $res[] = ['Year', 'names', 'emails'];
        foreach ($population as $key => $val) {
            $res[++$key] = [$val->year, (int)$val->names, (int)$val->emails];
        }

        return view('home')
            ->with('population', json_encode($res));
    }
}
