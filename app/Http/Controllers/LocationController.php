<?php

namespace App\Http\Controllers;
use App\Models\District;
use App\Models\City;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getDistricts($state_id)
    {
        return response()->json(District::where('state_id', $state_id)->get());
    }

    public function getCities($district_id)
    {
        return response()->json(City::where('district_id', $district_id)->get());
    }
}
