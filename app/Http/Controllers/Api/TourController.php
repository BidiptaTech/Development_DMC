<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Tour;

class TourController extends Controller
{
    /*
    * Create Tour unique Id.
    * Date 28-11-2024
    */
    public function createTour(Request $request)
    {
        $validatedData = $request->validate([
            'destination' => 'required|string',
            'adult' => 'required|integer',
            'child' => 'required|integer',
            'infant'=> 'required|integer',
            'check_in' => 'required|string',
            'check_out' => 'required|string',
        ]);
        
        $checkInTime = Carbon::createFromFormat('d/m/Y, h:ia', $request->check_in);
        $checkOutTime = Carbon::createFromFormat('d/m/Y, h:ia', $request->check_out);
        $tour = new Tour();
        $tour->destination = $request->destination;  
        $tour->adult = $request->adult;  
        $tour->child = $request->child;
        $tour->infant = $request->infant;
        $tour->check_in_time = $checkInTime;  
        $tour->check_out_time = $checkOutTime; 
        $tour->save(); 
        return response()->json(['message' => 'Tour created successfully'], 201);
    }

    
}
