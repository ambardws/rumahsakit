<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;

class DependentDropdownController extends Controller
{

    public function store(Request $request)
    {
        $kota = City::where('province_id', $request->get('id'))
            ->pluck('name');

        return response()->json($kota);
    }
}
