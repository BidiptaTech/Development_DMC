<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;
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
            'management_comp_name' => $request->input('management_comp_name'),
            'status' => $request->input('hotel_status'),
            'images' => json_encode($imagePaths),
            'is_complete' => 1,
        ]);
        
        if ($hotel->is_complete == 1) {
            return redirect()->route('hotels.contact', ['hotel' => $hotel->id])->with('success', 'Hotel created successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Something went wrong, please try again');
        }
    }

    /*
    * Editing Hotel details.
    * Date 15-11-2024
    */
    public function edit($id)
    {
        $categories = Category::where('category_type', 1)->get();
        $hotel = Hotel::findOrFail($id);
        return view('hotel.edit-hotel', compact('categories', 'hotel'));
    }

    /*
    * Update Hotel details.
    * Date 15-11-2024
    */
    public function update(Request $request, $id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
            'pincode' => 'required|integer',
            'category_type' => 'required',
            'state' => 'required',
            'country' => 'required',
            'hotel_status' => 'required',
        ]);

        // Find the hotel by ID
        $hotel = Hotel::findOrFail($id);

        // Handle the main image upload (if exists)
        $storage_file = $hotel->main_image; // Default to current image if no new one is uploaded
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $storage_file = CommonHelper::image_path('file_storage', $image); // Assuming this returns the file path as a string
        }

        // Handle multiple image uploads for additional images (if exists)
        $imagePaths = json_decode($hotel->images, true); // Existing images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = CommonHelper::image_path('hotel_images', $image); // Assuming this returns the file path as a string
            }
        }

        // Update the hotel record in the database
        $hotel->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'cat_id' => $request->input('category_type'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
            'zipcode' => $request->input('pincode'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'main_image' => $storage_file, // Store the image path directly (as a string)
            'check_in_time' => $request->input('check_in_time'),
            'check_out_time' => $request->input('check_out_time'),
            'hotel_owner_company_name' => $request->input('hotel_owner_company_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'description' => $request->input('description'),
            'policies' => $request->input('policies'),
            'management_comp_name' => $request->input('management_comp_name'),
            'status' => $request->input('hotel_status'),
            'images' => json_encode($imagePaths), // Store the updated image paths as a JSON array
            'is_complete' => 1,
        ]);

        // After updating the hotel, redirect based on the completion status
        if ($hotel->is_complete == 1) {
            return redirect()->route('hotels.contact', ['hotel' => $hotel->id])->with('success', 'Hotel updated successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Something went wrong, please try again');
        }
    }



    /*
    * Soft Delete Hotels.
    * Date 05-11-2024
    */
    public function destroy($id)
    {
        $delete =Hotel::where('id', $id)->delete();
        $delete =Room::where('hotel_id', $id)->delete();
        return redirect()->route('hotels.index')
        ->with('success','Hotel deleted successfully');
    }
    
    /*
    * Contact Details of Hotel.
    * Date 15-11-2024
    */
    public function hotelcontacts($hotelId){
        $hotel = Hotel::findOrFail($hotelId);
        return view('hotel.contactdetails', compact('hotel'));
    }

    /*
    * Edit Contact Details .
    * Date 15-11-2024
    */
    public function editcontacts($hotelId){
        $hotel = Hotel::findOrFail($hotelId);
        return view('hotel.contactdetails', compact('hotel'));
    }

    /*
    * Update Contact Details of Hotel.
    * Date 15-11-2024
    */
    public function updatecontacts(Request $request){
        $hotel = Hotel::findOrFail($request->id);
        try {
            $hotel->update([
                'hotel_reservation_cont_no' => $request->hotel_reservation_cont_no,
                'hotel_reservation_email' => $request->hotel_reservation_email,
                'revenue_director_cont_no' => $request->revenue_director_cont_no,
                'revenue_director_email' => $request->revenue_director_email,
                'sales_director_cont_no' => $request->sales_director_cont_no,
                'sales_director_email' => $request->sales_director_email,
                'finance_director_cont_no' => $request->finance_director_cont_no,
                'finance_director_email' => $request->finance_director_email,
                'food&beverage_director_cont_no' => $request->beverage_director_cont_no,
                'food&beverage_director_email' => $request->beverage_director_email,
                'marketing_manager_cont_no' => $request->marketing_manager_cont_no,
                'marketing_manager_email' => $request->marketing_manager_email,
                'account_manager_cont_no' => $request->account_manager_cont_no,
                'account_manager_email' => $request->account_manager_email,
                'general_manager_cont_no' => $request->general_manager_cont_no,
                'general_manager_email' => $request->general_manager_email,
            ]);

            return redirect()->route('hotels.room', ['hotel' => $hotel->id])->with('success', 'Hotel Contacts created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /*
    * Room Details of Hotel.
    * Date 15-11-2024
    */
    public function hotelrooms($hotelId){
        $hotel = Hotel::findOrFail($hotelId);
        $rooms = Room::where('hotel_id', $hotelId)->get();
        return view('hotel.rooms', compact('hotel','rooms'));
    }

    /*
    * Store new Rooms.
    * Date 15-11-2024
    */
    public function storeroom(Request $request)
    {
        $request->validate([
            'room_number' => 'required',
            'max_capacity' => 'required',
            'available' => 'required',
            'cancellation_type' => 'required', 
            'hotel_status' => 'required', 
        ]);

        $room = new Room(); 
        $room->hotel_id = $request->id;
        $room->room_number = $request->room_number;
        $room->max_capacity = $request->max_capacity;
        $room->is_available = $request->available;
        $room->cancellation_type = $request->cancellation_type;
        $room->cancellation_charge = $request->charge ?? 0; 
        $room->status = $request->hotel_status;
        // $room->room_type_id = $request->room_type;
        $room->is_complete = 1;

        if ($room->save()) {
            return redirect()->back()
                ->with('success', 'Room details saved successfully!');
        } else {
            return redirect()->back()
                ->with('error', 'An error occurred while saving the room details.');
        }
    }

    /*
    * Edit Room Details .
    * Date 18-11-2024
    */
    public function editroom(Request $request, $id){
        $room = Room::findOrFail($id);
        return view('hotel.editroom', compact('room'));
    }

    /*
    * Update Room Details .
    * Date 18-11-2024
    */
    public function updateroom(Request $request)
    {
        $request->validate([
            'room_number' => 'required',
            'max_capacity' => 'required',
            'available' => 'required',
            'cancellation_type' => 'required',
            'hotel_status' => 'required',
        ]);
        $id = $request->id;
        $room = Room::findOrFail($id);
        // Update the room details
        $room->hotel_id = $room->hotel_id;
        $room->room_number = $request->room_number;
        $room->max_capacity = $request->max_capacity;
        $room->is_available = $request->available;
        $room->cancellation_type = $request->cancellation_type;
        $room->cancellation_charge = $request->charge ?? 0;
        $room->status = $request->hotel_status;
        // $room->room_type_id = $request->room_type;
        $room->is_complete = 1;

        // Save the updated room
        if ($room->save()) {
            return redirect()->route('hotels.room', ['hotel' => $room->hotel_id])
                ->with('success', 'Room details updated successfully!');
        } else {
            return redirect()->back()
                ->with('error', 'An error occurred while updating the room details.');
        }   
    }

    /*
    * Delete Room Details .
    * Date 18-11-2024
    */
    public function deleteroom($id){
        dd($id);
    }
    
}
