<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\RoomRate;

class HotelController extends Controller
{
    /*
    * Display a listing of the Hotels.
    * Date 04-11-2024
    */
    public function index(Request $request)
    {
        $hotels = Hotel::orderBy('id','DESC')->paginate(5);
        return view('hotel.hotels',compact('hotels'));
    }

    /*
    * Show the form for creating a new hotel.
    * Date 04-11-2024
    */
    public function create()
    {
        return view('hotel.add-hotel');
    }

    /*
    * Store new hotel.
    * Date 05-11-2024
    */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'rating' => 'required|integer', 
            'price' => 'required|numeric',
            'image' => 'required|string',
            'status' => 'required',
        ]);

        $hotel = Hotel::create([
            'name' => $validatedData['name'],
            'location' => $validatedData['location'],
            'star' => $validatedData['rating'],
            'image' => $validatedData['image'],
            'base_price' => $validatedData['price'],
            'status' => $validatedData['status'],
        ]);

        foreach ($request->input('category_type', []) as $index => $categoryType) {
            $single_rate = null;
            $double_rate = null;
            $triple_rate = null;
        
            $roomType = $request->input('room_type')[$index];
            $roomPrice = $request->input('room_price')[$index];
        
            if ($roomType == 'single') {
                $single_rate = $roomPrice;
            } elseif ($roomType == 'double') {
                $double_rate = $roomPrice; 
            } elseif ($roomType == 'triple') {
                $triple_rate = $roomPrice; 
            }
        
            $hotel->categories()->create([ 
                'category' => $categoryType, 
                'rate_type' => $request->input('rate_type')[$index], 
                'single_rate' => $single_rate,
                'double_rate' => $double_rate,
                'triple_rate' => $triple_rate,
                'kids_below_6' => $request->input('kids_below6')[$index],
                'kids_above_6' => $request->input('kids_above6')[$index],
                'breakfast' => $request->input('breakfast')[$index],
                'lunch' => $request->input('lunch')[$index],
                'dinner' => $request->input('dinner')[$index],
                'breakfast_kids_below_6' => $request->input('breakfastkids')[$index],
                'lunch_kids_below_6' => $request->input('lunchkids')[$index],
                'dinner_kids_below_6' => $request->input('dinnerkids')[$index],
                'extra_bed' => $request->input('extrabed')[$index],
            ]);
        }

        return redirect()->route('hotels.index')
            ->with('success', 'Hotels created successfully');
    }

    /*
    * Soft Delete Hotels.
    * Date 05-11-2024
    */
    public function destroy($id)
    {
        $delete =Hotel::where('id', $id)->delete();
        $delete =RoomRate::where('hotel_id', $id)->delete();
        return redirect()->route('hotels.index')
        ->with('success','Hotel deleted successfully');
    }
}
