<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room; 
use App\Models\Rate; 
use App\Models\Setting;
use App\Models\Category;
use App\Models\RoomType;
use App\Models\Bed;
use App\Helpers\CommonHelper;
use Illuminate\Support\Facades\Storage;
use Auth; 
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
        $facilities = Facility::all();
        return view('hotel.add-hotel', compact('categories', 'facilities'));
    }

    /*
    * Store new hotel.
    * Date 05-11-2024
    */
    public function store(Request $request)
    {
        $uniqueId = uniqid('', true);
        $unique_id = substr($uniqueId, -16);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'category_type' => 'required|integer',
            'phone' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'pincode' => 'required|integer',
            'latitude' => 'required',
            'longitude' => 'required',
            'check_in_time' => 'required',
            'check_out_time' => 'required',
            'facilities' => 'required|array',
            'hotel_status' => 'required|integer',
            'main_image' => 'nullable|image',
            'images.*' => 'nullable|image',
        ]);

            $imagePath = null;
            if ($request->hasFile('main_image')) {
                $image = $request->file('main_image');
                $mainImagePath = CommonHelper::image_path('file_storage', $image);
            }

            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $pathData = CommonHelper::image_path('file_storage', $image);
                    if (!empty($pathData['master_value'])) {
                        $imagePaths[] = $pathData['master_value']; 
                    }
                }
            }

            // implement future Process conference data should be 
            // $conferenceData = [];
            // if ($request->input('conference') == 1) {
            //     foreach ($request->input('conference_head', []) as $index => $head) {
            //         $conferenceData[] = [
            //             'head' => $head,
            //             'duration' => $request->input('conference_duration')[$index] ?? null,
            //             'price' => $request->input('conference_price')[$index] ?? null,
            //         ];
            //     }
            // }

            // Process cancellation data
            $cancellationData = [];
            if ($request->input('cancellation_type') == 1) {
                foreach ($request->input('cancellation_duration', []) as $index => $duration) {
                    $cancellationData[] = [
                        'duration' => $duration,
                        'price' => $request->input('cancellation_price')[$index] ?? null,
                    ];
                }
            }

            // Handle port of entry and exit data
            $portOfEntryData = $this->processPortData(
                $request->input('port_name', []),
                $request->input('latitudentry', []),
                $request->input('longitudeentry', []),
                $request->input('distanceentry', []),
            );

            $portOfExitData = $this->processPortData(
                $request->input('exit_port_name', []),
                $request->input('exit_latitude', []),
                $request->input('exit_longitude', []),
                $request->input('exit_distance', []),
            );

            $portOfOtherData = $this->processPortData(
                $request->input('others_port_name', []),
                $request->input('others_latitude', []),
                $request->input('others_longitude', []),
                $request->input('others_distance', []),
            );

            // Create hotel record
            $auth_user = Auth::user();
            $hotel = Hotel::create([
                'user_type' => $auth_user->user_type,
                'userId' => $auth_user->id,
                'name' => $request->input('name'),
                'hotel_unique_id' => $unique_id,
                'address' => $request->input('address'),
                'infant_age_limit' => $request->input('infant_age_limit'),
                'child_age_limit' => $request->input('child_age_limit'),
                '12_hour_book' => $request->input('date_range'),
                'conference_room' => $request->input('conference'),
                'cancellation_type' => $request->input('cancellation_type'),
                'city' => $request->input('city'),
                'cat_id' => $request->input('category_type'),
                'state' => $request->input('state'),
                'country' => $request->input('country'),
                'zipcode' => $request->input('pincode'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'main_image' => $mainImagePath['master_value'],
                'check_in_time' => $request->input('check_in_time'),
                'check_out_time' => $request->input('check_out_time'),
                'hotel_owner_company_name' => $request->input('hotel_owner_company_name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'description' => $request->input('description'),
                'policies' => $request->input('policies'),
                'management_comp_name' => $request->input('management_comp_name'),
                'status' => $request->input('hotel_status'),
                'weekend_days' => json_encode($request->input('weekend_days')),
                // 'conference_data' => json_encode($conferenceData),
                'cancellation_data' => json_encode($cancellationData),
                'images' => json_encode($imagePaths),
                'facilities' => json_encode($request->input('facilities')),
                'port_of_entry' => json_encode($portOfEntryData),
                'port_of_exit' => json_encode($portOfExitData),
                'others' => json_encode($portOfOtherData),
                'twelve_hours_charge' => $request->input('twelve_hours_booking_price'),
                'is_complete' => 1,
            ]);

            return redirect()->route('hotels.contact', ['hotel' => $hotel->id])
                ->with('success', 'Hotel created successfully');
    
    }

/**
 * Helper function to process port data.
 */
    private function processPortData($names, $latitudes, $longitudes, $distances)
    {
        $data = [];

        foreach ($names as $index => $name) {
            if (!empty($latitudes[$index]) && !empty($longitudes[$index]) && !empty($distances[$index])) {
                $data[] = [
                    'port_name' => $name,
                    'latitude' => $latitudes[$index],
                    'longitude' => $longitudes[$index],
                    'distance' => $distances[$index],
                ];
            }
        }
        return $data;
    }

    /*
    * Editing Hotel details.
    * Date 15-11-2024
    */
    public function edit($id)
    {
        $facilities = Facility::all();
        $categories = Category::where('category_type', 1)->get();
        $hotel = Hotel::findOrFail($id);
        $cancellation_data = json_decode($hotel->cancellation_data, true) ?? [];
        $entry_data = json_decode($hotel->port_of_entry, true) ?? [];
        $exit_data = json_decode($hotel->port_of_exit, true) ?? [];
        $others = json_decode($hotel->others, true) ?? [];
        $enable_port_of_entry = !empty($entry_data);
        $enable_port_of_exit = !empty($exit_data);
        $others_data = !empty($others);
        return view('hotel.edit-hotel', compact('categories', 'hotel','facilities','entry_data','exit_data','enable_port_of_entry','enable_port_of_exit','others','others_data','cancellation_data'));
    }

    /*
    * Update Hotel details.
    * Date 15-11-2024
    */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'category_type' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required|string',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required|integer',
            'latitude' => 'required',
            'longitude' => 'required',
            'check_in_time' => 'required',
            'check_out_time' => 'required',
            'facilities' => 'required|array',
            'hotel_status' => 'required',
        ]);

        $hotel = Hotel::findOrFail($id);
        $storage_file = $hotel->main_image;
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $storage_file = CommonHelper::image_path('file_storage', $image);
        }

        $imagePaths = json_decode($hotel->images, true) ?: []; // Existing images, default to empty array
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $pathData = CommonHelper::image_path('file_storage', $image);
                if (!empty($pathData['master_value'])) {
                    $imagePaths[] = $pathData['master_value']; 
                }
            }
        }

        //Future Implement
        // if ($request->conference == 1) {
        //     $conferenceData = [];
        //     if ($request->has('conference_head')) {
        //         foreach ($request->conference_head as $index => $head) {
        //             $conferenceData[] = [
        //                 'head' => $head,
        //                 'duration' => $request->conference_duration[$index] ?? null,
        //                 'price' => $request->conference_price[$index] ?? null,
        //             ];
        //         }
        //     }
        //     $conferenceDataJson = json_encode($conferenceData);
        // } else {
        //     $conferenceDataJson = null;
        // }

        if ($request->cancellation_type == 1) {
            $cancellationData = [];
            if ($request->has('cancellation_duration') && is_array($request->cancellation_duration)) {
                foreach ($request->cancellation_duration as $index => $duration) {
                    $cancellationData[] = [
                        'duration' => $duration,
                        'price' => $request->cancellation_price[$index] ?? null, // Default to null if price is missing
                    ];
                }
            }
            $cancellationDataJson = !empty($cancellationData) ? json_encode($cancellationData) : null;
        } else {
            $cancellationDataJson = null;
        }
        // Handle port of entry and exit data
        $portOfEntryData = $this->processPortData(
            $request->input('port_name', []),
            $request->input('latitudentry', []),
            $request->input('longitudentry', []),
            $request->input('distancentry', []),
        );
        $portOfExitData = $this->processPortData(
            $request->input('exit_port_name', []),
            $request->input('exit_latitude', []),
            $request->input('exit_longitude', []),
            $request->input('exit_distance', []),
        );

        $portOfOtherData = $this->processPortData(
            $request->input('others_port_name', []),
            $request->input('others_latitude', []),
            $request->input('others_longitude', []),
            $request->input('others_distance', []),
        );

        $hotel->update([
            'name' => $request->input('name'),
            'hotel_unique_id' => $hotel->hotel_unique_id,
            'address' => $request->input('address'),
            'infant_age_limit' => $request->input('infant_age_limit'),
            'child_age_limit' => $request->input('child_age_limit'),
            'weekend_days' => json_encode($request->weekend_days),
            '12_hour_book' => $request->input('date_range'),
            'twelve_hours_charge' => $request->input('day_usage_price'),
            'conference_room' => $request->input('conference'),
            // 'conference_data' => $conferenceDataJson ?? '',
            'cancellation_type' => $request->input('cancellation_type'),
            'cancellation_data' => $cancellationDataJson,
            'city' => $request->input('city'),
            'cat_id' => $request->input('category_type'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
            'zipcode' => $request->input('pincode'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'main_image' => $storage_file['master_value'] ?? $storage_file,
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
            'facilities' => json_encode($request->facilities),
            'port_of_entry' => !empty($portOfEntryData) ? json_encode($portOfEntryData) : $hotel->port_of_entry,
            'port_of_exit' => json_encode($portOfExitData) ?? $hotel->port_of_exit,
            'others' => json_encode($portOfOtherData) ?? $hotel->others,
            'is_complete' => 1,
        ]);

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
                'food_beverage_director_cont_no' => $request->beverage_director_cont_no,
                'food_beverage_director_email' => $request->beverage_director_email,
                'marketing_manager_cont_no' => $request->marketing_manager_cont_no,
                'marketing_manager_email' => $request->marketing_manager_email,
                'account_manager_cont_no' => $request->account_manager_cont_no,
                'account_manager_email' => $request->account_manager_email,
                'general_manager_cont_no' => $request->general_manager_cont_no,
                'general_manager_email' => $request->general_manager_email,
                'whatsapp' => $request->whatsapp,
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
        $roomtypes = RoomType::where('status', 1)->get();
        $rooms = Room::where('hotel_id', $hotelId)->get();
        $beds = Bed::where('is_active', 1)->get();
        return view('hotel.rooms', compact('hotel','rooms','roomtypes','beds'));
    }

    public function hotelrates($hotelId){
        
        $hotel = Hotel::findOrFail($hotelId);
        $rooms = Room::where('hotel_id', $hotelId)->get();
        $rates = Rate::all();
        return view('hotel.rates', compact('hotel','rooms','rates'));
    }

    /*
    * Store new Rooms.
    * Date 15-11-2024
    */
    public function storeroom(Request $request)
    {
        $request->validate([

        // 'room_type' => 'required|string|max:255',
        // 'no_of_room' => 'required|integer|min:1',
        // 'weekday_price' => 'required|numeric|min:0',
        // 'weekend_price' => 'required|numeric|min:0',
        'breakfast' => 'required|boolean',
        'breakfast_type' => 'nullable|string|max:255',
        'breakfast_price' => 'nullable|numeric|min:0',
        'lunch' => 'required|boolean',
        'lunch_type' => 'nullable|string|max:255',
        'lunch_price' => 'nullable|numeric|min:0',
        'dinner' => 'required|boolean',
        'dinner_type' => 'nullable|string|max:255',
        'dinner_price' => 'nullable|numeric|min:0',
        'breakfast_included' => 'required|boolean',
        'event.*' => 'nullable|string|max:255',
        'event_type.*' => 'nullable|string|max:255',
        'price.*' => 'nullable|numeric|min:0',
        'start_date.*' => 'nullable|date',
        'end_date.*' => 'nullable|date|after:start_date',
        ]);

        

        $lastRoom = Room::withTrashed()->orderBy('id', 'desc')->first();
        $room_max_id = $lastRoom->room_id ?? 0;
        $roomId = CommonHelper::createId($room_max_id);
        while (Room::where('room_id', $roomId)->exists()) {
            $roomId = CommonHelper::createId($roomId);
        }
        
        $room = new Room(); 
       
        
        $room->hotel_id = $request->id;
        $room->room_type = $request->base_room_type ? $request->base_room_type : $request->room_type;
        $room->no_of_room = $request->no_of_room;
        $room->weekday_price = $request->base_weekday_price ? $request->base_weekday_price : $request->weekday_price;
        $room->weekend_price = $request->base_weekend_price ? $request->base_weekend_price : $request->weekend_price;
        $room->varient_price = $request->varient_price??0;

        $room->breakfast = $request->breakfast;
        $room->breakfast_type = $request->breakfast_type;
        $room->breakfast_price = $request->breakfast_price;

        $room->lunch = $request->lunch;
        $room->lunch_type = $request->lunch_type;
        $room->lunch_price = $request->lunch_price;

        $room->dinner = $request->dinner;
        $room->dinner_type = $request->dinner_type;
        $room->dinner_price = $request->dinner_price;
        $room->breakfast_included = $request->breakfast_included;
       
        $room->status = $request->hotel_status;
        $room->room_id = $roomId;
        $room->save();
        

        // Validate the incoming request data
        $validated = $request->validate([
            
            'king_bed_no_of_rooms' => 'nullable|integer',
            'king_bed_max_occupancy' => 'nullable|integer',
            'king_bed_adult_count' => 'nullable|integer',
            'king_bed_child_count' => 'nullable|integer',
            'king_bed_extra_bed' => 'nullable|boolean',
            'king_bed_extra_bed_price' => 'nullable|numeric',
            'king_bed_baby_cot' => 'nullable|boolean',
            'king_bed_baby_cot_price' => 'nullable|numeric',
            'queen_bed_no_of_rooms' => 'nullable|integer',
            'queen_bed_max_occupancy' => 'nullable|integer',
            'queen_bed_adult_count' => 'nullable|integer',
            'queen_bed_child_count' => 'nullable|integer',
            'queen_bed_extra_bed' => 'nullable|boolean',
            'queen_bed_extra_bed_price' => 'nullable|numeric',
            'queen_bed_baby_cot' => 'nullable|boolean',
            'queen_bed_baby_cot_price' => 'nullable|numeric',
            'twin_bed_no_of_rooms' => 'nullable|integer',
            'twin_bed_max_occupancy' => 'nullable|integer',
            'twin_bed_adult_count' => 'nullable|integer',
            'twin_bed_child_count' => 'nullable|integer',
            'twin_bed_extra_bed' => 'nullable|boolean',
            'twin_bed_extra_bed_price' => 'nullable|numeric',
            'twin_bed_baby_cot' => 'nullable|boolean',
            'twin_bed_baby_cot_price' => 'nullable|numeric',
        ]);

        $lastBed = Bed::withTrashed()->orderBy('id', 'desc')->first();
        $bed_max_id = $lastBed->bedId ?? 0;
        $bedId = CommonHelper::createId($bed_max_id);
        while (Bed::where('bedId', $bedId)->exists()) {
            $bedId = CommonHelper::createId($bedId);
        }

        $lastRoomId = Room::latest()->value('room_id');

        // Create a new RoomBed instance and save to database
        
        $bed = new Bed();

        $bed->king_bed_no_of_rooms = $validated['king_bed_no_of_rooms'] ?? 0;
        $bed->king_bed_max_occupancy = $validated['king_bed_max_occupancy'] ?? 0;
        $bed->king_bed_adult_count = $validated['king_bed_adult_count'] ?? 0;
        $bed->king_bed_child_count = $validated['king_bed_child_count'] ?? 0;
        $bed->king_bed_extra_bed = $validated['king_bed_extra_bed'] ?? false;
        $bed->king_bed_extra_bed_price = $validated['king_bed_extra_bed_price'] ?? 0.00;
        $bed->king_bed_baby_cot = $validated['king_bed_baby_cot'] ?? false;
        $bed->king_bed_baby_cot_price = $validated['king_bed_baby_cot_price'] ?? 0.00;

        $bed->queen_bed_no_of_rooms = $validated['queen_bed_no_of_rooms'] ?? 0;
        $bed->queen_bed_max_occupancy = $validated['queen_bed_max_occupancy'] ?? 0;
        $bed->queen_bed_adult_count = $validated['queen_bed_adult_count'] ?? 0;
        $bed->queen_bed_child_count = $validated['queen_bed_child_count'] ?? 0;
        $bed->queen_bed_extra_bed = $validated['queen_bed_extra_bed'] ?? false;
        $bed->queen_bed_extra_bed_price = $validated['queen_bed_extra_bed_price'] ?? 0.00;
        $bed->queen_bed_baby_cot = $validated['queen_bed_baby_cot'] ?? false;
        $bed->queen_bed_baby_cot_price = $validated['queen_bed_baby_cot_price'] ?? 0.00;

        $bed->twin_bed_no_of_rooms = $validated['twin_bed_no_of_rooms'] ?? 0;
        $bed->twin_bed_max_occupancy = $validated['twin_bed_max_occupancy'] ?? 0;
        $bed->twin_bed_adult_count = $validated['twin_bed_adult_count'] ?? 0;
        $bed->twin_bed_child_count = $validated['twin_bed_child_count'] ?? 0;
        $bed->twin_bed_extra_bed = $validated['twin_bed_extra_bed'] ?? false;
        $bed->twin_bed_extra_bed_price = $validated['twin_bed_extra_bed_price'] ?? 0.00;
        $bed->twin_bed_baby_cot = $validated['twin_bed_baby_cot'] ?? false;
        $bed->twin_bed_baby_cot_price = $validated['twin_bed_baby_cot_price'] ?? 0.00;
        $bed->bedId = $bedId;
        $bed->room_id = $lastRoomId;

        $bed->save();
        
        if ($room->save()) {
            return redirect()->back()
                ->with('success', 'Room details saved successfully!');
        } else {
            return redirect()->back()
                ->with('error', 'An error occurred while saving the room details.');
        }
    }

    /**
     * store rates
     * 
     */
    public function storerates(Request $request){

        $lastRoomId = Room::latest()->value('room_id');
        $lastRate = Rate::withTrashed()->orderBy('rate_id', 'desc')->first();
        if ($lastRate) {
            $rateId = $lastRate->rate_id + 1;
        } else {
            $rateId = 1;
        }
        while (Rate::where('rate_id', $rateId)->exists()) {
            $rateId++;  
        }

        $rate = Rate::create([
            'event' => $request->event,
            'room_id' => $lastRoomId, 
            'hotel_id' => $request->id,
            'rate_id' => $rateId,
            'event_type' => $request->event_type,
            'price' => $request->price,
            'weekday_price' => $request->weekday_price ? $request->weekday_price : 0.00,
            'weekend_price' => $request->weekend_price ? $request->weekend_price : 0.00,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        if ($rate->save()) {
            return redirect()->back()
                ->with('success', 'Rates details saved successfully!');
        } else {
            return redirect()->back()
                ->with('error', 'An error occurred while saving the room details.');
        }
    }

    /*
    * Edit Rate Details .
    * Date 15-12-2024
    */
    public function editrate($id, $hotelId){
        $rate = Rate::where('rate_id', $id)->first();
        $hotel = Hotel::where('id', $hotelId)->first();
        
        return view('hotel.edit-rate', compact('rate','hotel'));
    }

    public function updaterates(Request $request){
     
        $rate_id = $request->rate_id;
        
        $hotel = Hotel::where('id', $request->hotel_id)->first();

        $rate = Rate::where('rate_id', $rate_id)->first();
        $rate->event = $request->event;
        $rate->event_type = $request->event_type;  // Correct assignment of 'event_type'
        $rate->price = $request->price;
        $rate->weekday_price = $request->weekday_price ? $request->weekday_price : 0.00;
        $rate->weekend_price = $request->weekend_price ? $request->weekend_price : 0.00;
        $rate->start_date = $request->start_date;
        $rate->end_date = $request->end_date;

        if ($rate->save()) {
            $rates = Rate::all();
            return view('hotel.rates', compact('hotel', 'rates'))
                ->with('success', 'Rates details saved successfully!');
        } else {
            return redirect()->back()
                ->with('error', 'An error occurred while saving the rate details.');
        }
    }

    /*
    * Edit Room Details .
    * Date 18-11-2024
    */
    public function editroom(Request $request, $id){
        $room = Room::with('rates')->findOrFail($id);
        $beds = Bed::where('is_active', 1)->get();
        return view('hotel.editroom', compact('room','beds'));
    }



    /*
    * Update Room Details .
    * Date 18-11-2024
    */
    public function updateroom(Request $request)
    {
        $request->validate([
            'room_type' => 'required',
            'max_capacity' => 'required',
            'no_of_room' => 'required',
            'weekday_price' => 'required',
            'weekend_price' => 'required',
            'hotel_status' => 'required',
            'extra_bed' => 'required',
            'child_cot' => 'required',
        ]);
        $id = $request->id;
        $room_id = Room::where('id', $id)->first();
        $room = Room::where('room_id',$room_id->room_id)->first();

        // Update the room details
        $room->room_type = $request->base_room_type ? $request->base_room_type : $request->room_type;
        $room->no_of_room = $request->no_of_room;
        $room->weekday_price = $request->base_weekday_price ? $request->base_weekday_price : $request->weekday_price;
        $room->weekend_price = $request->base_weekend_price ? $request->base_weekend_price : $request->weekend_price;
        $room->varient_price = $request->varient_price;
        $room->max_capacity = $request->max_capacity;
        $room->adult_count = $request->adult_count ?? $room->adult_count;
        $room->child_count = $request->child_count ?? $room->child_count;
        $room->extra_bed = $request->extra_bed;
        $room->bed_type = $request->bed_type;
        $room->extra_bed_price = $request->extra_bed_price;
        $room->child_cot = $request->child_cot;
        $room->child_cot_price = $request->child_cot_price;
        $room->status = $request->hotel_status;
        $room->is_complete = 1;
        $room->save();

        // Update rates
        $existingRates = $room->rates; // Fetch existing rates for the room
        $newRates = $request->event;

        // Remove rates not in the new request
        foreach ($existingRates as $existingRate) {
            if (!in_array($existingRate->event, $newRates)) {
                $existingRate->delete();
            }
        }

        // Update or create rates
        foreach ($newRates as $index => $eventName) {
            $rate = $room->rates()->where('event', $eventName)->first();

            if ($rate) {
                // Update existing rate
                $rate->update([
                    'event_type' => $request->event_type[$index],
                    'price' => $request->price[$index],
                    'start_date' => $request->start_date[$index],
                    'end_date' => $request->end_date[$index],
                ]);
            } else {
                // Create new rate
                $lastRate = Rate::withTrashed()->orderBy('rate_id', 'desc')->first();
                $rate_id = $lastRate->rate_id;
                $rateId = CommonHelper::createId($rate_id);

                while (Rate::where('rate_id', $rateId)->exists()) {
                    $rateId = CommonHelper::createId($rateId);
                }

                Rate::create([
                    'event' => $request->event,
                    'room_id' => $room_id->room_id, // Correctly reference the room ID
                    'hotel_id' => $request->id,
                    'rate_id' => $rateId,
                    'event_type' => $request->event_type,
                    'price' => $request->price,
                    'weekday_price' => $request->weekday_price,
                    'weekend_price' => $request->weekend_price,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]);
            }
        }

        return redirect()->route('hotels.room', ['hotel' => $room->hotel_id])
            ->with('success', 'Room details updated successfully!');
    }

    /*
    * Delete Room Details .
    * Date 18-11-2024
    */
    public function deleteroom($id){
        $room = Room::where('id', $id)->first();
        $delete =Room::where('id', $id)->delete();
        if ($delete) {
            return redirect()->route('hotels.room', ['hotel' => $room->hotel_id])
                ->with('success', 'Room details deleted successfully!');
        } else {
            return redirect()->back()
                ->with('error', 'An error occurred while updating the room details.');
        }  
    }
    
}
