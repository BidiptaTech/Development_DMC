<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\RoomRate;
use App\Models\Setting;
use App\Models\Category;
use App\Helpers\CommonHelper;
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
        $categories = Category::where('category_type', 1)->get();
        return view('hotel.add-hotel', compact('categories'));
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
            'category_type' => 'required',
            'state' => 'required',
            'country' => 'required', 
            'hotel_status' => 'required', 
        ]);

        $imagePath = null;
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $storage_file = CommonHelper::image_path('file_storage', $image);
        }

        // Handling multiple image uploads
        $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePaths[] = CommonHelper::image_path('hotel_images', $image);
                }
            }

        $hotel = Hotel::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'cat_id' => $request->input('category_type'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
            'zipcode' => $request->input('pincode'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'main_image' => $storage_file['master_value'],
            'check_in_time' => $request->input('check_in_time'),
            'check_out_time' => $request->input('check_out_time'),
            'hotel_owner_company_name' => $request->input('hotel_owner_company_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'description' => $request->input('description'),
            'policies' => $request->input('policies'),
            // 'management_comp_name' => $request->input('management_comp_name'),
            'status' => $request->input('hotel_status'),
            'images' => json_encode($imagePaths),
            'is_complete' => 1,
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
