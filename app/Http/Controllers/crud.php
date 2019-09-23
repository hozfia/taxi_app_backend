<?php

namespace App\Http\Controllers;

use App\DriverModel ; 
use Illuminate\Http\Request;

class crud extends Controller
{
    //
    public function index()
    {
        $driver = DriverModel::all();
        $data   = $driver->toArray();
 
        return response()->json([
            'success' => true,
            'data' => $data 
        ]);
    }

}
