<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Models\Category;
use App\Models\Facility;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomtypeController extends Controller
{
    //Render Index page of Room Type (roomType/roomsType.blade.php)
    public function index(Request $request)
    {
        $rooms = Room::all();

        return view('roomType.roomsType',compact('rooms'));
    }

    //Render Add room type page (roomType/add-roomsType.blade.php)
    public function create(){

        $facilities = Facility::all();
        return view('roomType.add-roomsType', ['facilities'=>$facilities]);
    }

    //Handle Store Function Of New Room Type Details
    public function store(Request $request)
    {
        $this->validate($request, [
            'hotelUniqueId' => 'required',
            'roomType' => 'required',
            'breakfast' => 'required',
            'lunch' => 'required',
            'dinner' => 'required',
            'extra_bed' => 'required',
            'facilities' => 'required',
            'status_type' => 'required',
            'icon' => 'required',
        ]);
        $image = $request->file('icon');
        $storage_file = CommonHelper::image_path('file_storage', $image);
        $role = Category::create([
            'name' => $request->input('name'),
            'category_type' => $request->input('category_type'),
            'status' => $request->input('category_status'),
            'icon' => $storage_file['master_value'],
        ]);
        return redirect()->route('category.index')
            ->with('success', 'Category created successfully');
    }

    //Send Selected hotel facilities through AJAX Call
    public function getHotelFacilities($hotelId)
    {
        $facilities = Facility::where('hotel_id', $hotelId)->get();

        if ($facilities->isEmpty()) {
            return response()->json(['success' => false, 'facilities' => []], 404);
        }

        return response()->json([
            'success' => true,
            'facilities' => $facilities,
        ]);
    }

    //Show the Hotels List Based on User Input Key
    public function search(Request $request)
    {
        $query = $request->get('query');

        // Fetch hotels with matching names
        $hotels = Hotel::where('name', 'ILIKE', '%' . $query . '%')
            ->select('id', 'name', 'city')
            ->limit(10)
            ->get();
       
        return response()->json($hotels);
    }

}
