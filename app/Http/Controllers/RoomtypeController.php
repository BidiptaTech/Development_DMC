<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Models\Category;
use App\Models\Facility;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomtypeController extends Controller
{
    //Render Index page of Room Type (roomType/roomsType.blade.php)
    public function index(Request $request)
    {
        $rooms = RoomType::orderBy('created_at', 'desc')->get();

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
        
        // dd($request->all());
        $validatedData = $this->validate($request, [
            
            'roomType' => 'required|string',
            'breakfast' => 'required',
            'lunch' => 'required',
            'dinner' => 'required',
            'extra_bed' => 'required',
            // 'facilities' => 'required|array',
            'room_status' => 'required',
            'description' => 'required|string',
            
        ]);
        
        $userId = Auth::id(); 
        $roomType = RoomType::create([
            'name' => $request->roomType, // Save the room type name
            'breakfast' => $request->breakfast,
            'lunch' => $request->lunch,
            'dinner' => $request->dinner,
            'extra_bed' => $request->extra_bed,
            'facilities' => json_encode($request->facilities),
            'inserted_by_user' => $userId,
            'description' => $request->description,
            'status' => $request->room_status,
            'hotel_id'=> $request->hotel_id,
        ]);
        return redirect()->route('roomType.index')
            ->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $roomType = RoomType::where('id',$id)->first();
        $hotel = Hotel::where('id',$roomType->hotel_id)->first();

        if(!$hotel){
            return response()->json(['error'=> 'Hotel not found']) ;
        }

        $facilities = []; // Initialize an empty array

        $facilityIds = json_decode($hotel->facilities, true); // Decode JSON string into array

        foreach ($facilityIds as $facilityId) {
            $facility = Facility::find($facilityId); // Use find for cleaner code
            if ($facility) {
                $facilities[] = $facility->name; // Add the facility name to the array
            }
        }
        return view('roomType.edit-roomsType', compact('roomType','hotel','facilities'));
    }

    public function update(Request $request, $id){
        $userId = Auth::id();
        $roomType = RoomType::where('id',$id)->first();
        $request->name!=null?$roomType->name = $request->name:'';
        $roomType->breakfast = $request->breakfast;
        $roomType->lunch = $request->lunch;
        $roomType->dinner = $request->dinner;
        $roomType->extra_bed = $request->extra_bed;
        $roomType->facilities = json_encode($request->facilities);
        $roomType->status = $request->room_status;
        $roomType->hotel_id = $request->hotel_id;
        $roomType->description = $request->description;
        $roomType->save();

        return redirect()->route('roomType.index')->with('success', 'Categories updated successfully.');
    }

    public function destroy($id){
        $roomType = RoomType::find($id);
        $roomType->delete();
        return redirect()->route('roomType.index')->with('success','Room Type deleted successfully');
    }

    //Send Selected hotel facilities through AJAX Call
    public function getHotelFacilities($hotelId)
    {
        $hotel = Hotel::findOrFail($hotelId);
        if(!$hotel){
            return response()->json(['error'=> 'Hotel not found']) ;
        }

        if (empty(json_decode($hotel->facilities, true))) {
            return response()->json(['success' => false, 'facilities' => []], 404);
        }

        $facilityNames = []; // Initialize an empty array

        $facilityIds = json_decode($hotel->facilities, true); // Decode JSON string into array

        foreach ($facilityIds as $facilityId) {
            $facility = Facility::find($facilityId); // Use find for cleaner code
            if ($facility) {
                $facilityNames[] = $facility->name; // Add the facility name to the array
            }
        }

        return response()->json([
            'success' => true,
            'facilities' => $facilityNames,
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

    public function toggle(Request $request)
{
    $roomType = RoomType::findOrFail($request->id);

    // Update the specified field with the new value
    $field = $request->field;
    if (in_array($field, ['breakfast', 'lunch', 'dinner', 'extra_bed'])) {
        $roomType->$field = $request->value;
        $roomType->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'Invalid field']);
}


}
