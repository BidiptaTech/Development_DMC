<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\RoomRate;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

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
            'city' => 'required|string',
            'pincode' => 'required|integer', 
            'state' => 'required',
            'country' => 'required', 
            'status' => 'required', 
        ]);

        $imagePath = null;
        if ($request->hasFile('main_image')) {
            $imagePath = $request->file('main_image')->store('hotel_images', 'public');
        }

        // Handling multiple image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('hotel_images', 'public');
            }
        }

        $hotel = Hotel::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
            'pincode' => $request->input('pincode'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'main_image' => $imagePath,
            'check_in_time' => $request->input('check_in_time'),
            'check_out_time' => $request->input('check_out_time'),
            'hotel_owner_company_name' => $request->input('hotel_owner_company_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'description' => $request->input('description'),
            'policies' => $request->input('policies'),
            'management_comp_name' => $request->input('management_comp_name'),
            'status' => $request->input('status'),
            'additional_images' => json_encode($imagePaths),
        ]);
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
