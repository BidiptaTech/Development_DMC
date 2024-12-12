<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Category;
use App\Models\Facility;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    /*
    * Show Hotel & Feature Category.
    * Date 07-11-2024
    */
    public function category()
    {
        $categories = Category::where('status', 1)->where('category_type', 1)->get();
        if ($categories->isEmpty()) {
            return response()->json([
                'message' => 'No category found'
            ], 404);
        }
        $category_list = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'category_name' => $category->name,
                'status' => $category->status,
            ];
        });
        return response()->json($category_list);
    }

    /*
    * Show Facilities.
    * Date 07-11-2024
    */
    public function facilities(Request $request)
    {
        $categories = Category::where('status', 1)
            ->where('category_type', 2)
            ->with(['facilities' => function ($query) {
                $query->where('status', 1); 
            }])
            ->get();
        if ($categories->isEmpty()) {
            return response()->json([
                'message' => 'No Categories with facilities found'
            ], 404);
        }
        $category_facilities = $categories->map(function ($category) {
            return [
                'category_id' => $category->id,
                'category_name' => $category->name,
                'facilities' => $category->facilities->map(function ($facility) {
                    return [
                        'id' => $facility->id,
                        'facility_name' => $facility->name,
                        'status' => $facility->status,
                    ];
                }),
            ];
        });
        return response()->json($category_facilities);
    }

    /*
    * Show Hotel Listings.
    * Date 06-11-2024
    */
    public function index(Request $request)
    {
        $location = $request->location;
        $cat_id = $request->category_id;
        if($location){
            $hotels = Hotel::with('category')->where('status', 1)
            ->orderBy('id', 'desc')->where('address', $location)
            ->get();
        }elseif ($cat_id) {
            $hotels = Hotel::with('category')->where('status', 1)->where('cat_id', $cat_id)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $hotels = Hotel::with('category')->where('status', 1)
                ->orderBy('id', 'desc')
                ->get();
        }

        $hotel_list = [];
        if ($hotels->count() > 0) {
            foreach ($hotels as $hotel) {
                $country = $hotel->country;
                $check_country = Country::whereRaw('LOWER(name) = ?', [strtolower($country)])->first();
                $country_tax = $check_country->tax_percentage ?? 0;
                $site_image = [];
                if (!empty($hotel->images)) {
                    $images = json_decode($hotel->images, true);
                    if (is_array($images)) {
                        $site_image = $images;
                    }
                }

                // Decode facility_ids stored in the hotel table
                $facility_ids = json_decode($hotel->facilities, true) ?? [];
                $facility_names = [];
                if (is_array($facility_ids)) {
                    $facility_names = Facility::whereIn('facilityId', $facility_ids)->pluck('name')->toArray();
                }

                $hotel_list[] = [
                    'id' => $hotel->id,
                    'hotel_name' => $hotel->name,
                    'category' => $hotel->category->name,
                    'location' => $hotel->address ?? '',
                    'price' => 5000,
                    'tax_amount' => (5000 * $country_tax/100),
                    'total_base_amount' => 5000 + (5000 * $country_tax/100),
                    'image' => $hotel->main_image ?? '',
                    'site_image' => $site_image,
                    'cancellation' => $hotel->cancellation_type,
                    'cancellation_charge' => json_decode($hotel->cancellation_data) ?? [],
                    'entry_port' => json_decode($hotel->port_of_entry) ?? [],
                    'exit_port' => json_decode($hotel->port_of_exit) ?? [],
                    'facilities' => $facility_names, // Facility names fetched here
                    'status' => $hotel->status,
                ];
            }
            return response()->json($hotel_list);
        } else {
            return response()->json([
                'message' => 'No hotels found'
            ], 404);
        }
    }


    /*
    * Show Hotel Details.
    * Date 07-11-2024
    */
    public function details(Request $request)
    {
        $id = $request->query('id');
        $hotel = Hotel::with('category','rooms')->where('status', 1)->where('id', $id)
                ->orderBy('id', 'desc')
                ->first();
        $hotel_list = [];
        if ($hotel) {
            $country = $hotel->country;
            $check_country = Country::whereRaw('LOWER(name) = ?', [strtolower($country)])->first();
            $country_tax = $check_country->tax_percentage ?? 0;
            $site_image = [];
            if (!empty($hotel->images)) {
                $images = json_decode($hotel->images, true);
                if (is_array($images)) {
                    $site_image = $images;
                }
            }
                $facility_ids = json_decode($hotel->facilities, true) ?? [];
            $facility_names = [];
            if (is_array($facility_ids)) {
                $facility_names = Facility::whereIn('facilityId', $facility_ids)->pluck('name')->toArray();
            }

            $room_data = [];
            foreach($hotel->rooms as $rooms){
                //weekday and weekend price calculate
                $weekend_days = json_decode($hotel->weekend_days);
                $today = Carbon::now()->format('l');
                if (in_array($today, $weekend_days)) {
                    $price = $rooms->weekend_price;
                }else{
                    $price = $rooms->weekday_price;
                }
                $room_data[] = [
                    'id' => $hotel->id,
                    'room_type' => $rooms->room_type,
                    'room_image' => json_decode($rooms->images) ?? [],
                    'number_of_room' => $rooms->no_of_room,
                    'price' => $price,
                    'breakfast_available' => $rooms->breakfast_included,
                ];
            }

            $hotel_list = [
                'id' => $hotel->id,
                'hotel_name' => $hotel->name,
                'category' => $hotel->category->name,
                'location' => $hotel->address ?? '',
                'price' => 5000,
                'tax_amount' => (5000 * $country_tax/100),
                'total_base_amount' => 5000 + (5000 * $country_tax/100),
                'image' => $hotel->main_image ?? '',
                'site_image' => $site_image,
                'cancellation' => $hotel->cancellation_type,
                'cancellation_charge' => json_decode($hotel->cancellation_data) ?? [],
                'entry_port' => json_decode($hotel->port_of_entry) ?? [],
                'exit_port' => json_decode($hotel->port_of_exit) ?? [],
                'facilities' => $facility_names,
                'status' => $hotel->status,
                'room_data' => $room_data,
            ];
            return response()->json($hotel_list);
        } else {
            return response()->json([
                'message' => 'No hotels found'
            ], 404);
        }
    }


    // public function roomLists(Request $request)
    // {
    //     $hotelId = $request->query('id');
        
        
    //     $hotel = Hotel::with([
    //         'rooms', // Eager load rooms
    //         'rooms.rates', // Eager load rates for each room
    //         'rooms.RoomType' // Eager load RoomType for each room
    //     ])->find($hotelId);
    
    //     if (!$hotel) {
    //         return response()->json(['message' => 'Hotel not found'], 404);
    //     }

    //     $roomsData = $hotel->rooms->map(function ($room) use($hotel) {
    //         $amenities = json_decode($room->facilities);

    //         return [
    //             'room_id' => $room->id,
    //             'room_type' => $room->RoomType->name ?? 'Unknown Room Type',
    //             'room_description' => $room->about ?? 'No description available',
    //             'rates' => $room->rates->map(function ($rate) use($hotel, $room) {
    //                 $today = strtolower(date('l'));

    //                 $weekend_days = json_decode($hotel->weekend_days, true);
    //                 if (in_array($today, $weekend_days)) {
    //                    $price = $room->weekend_price;
    //                 } else {
    //                     $price = $room->weekday_price;
    //                 }
    //                 return [
    //                     'rate_id' => $rate->id,
    //                     'title' => $rate->title ?? $rate->name,
    //                     'price' => $price,
    //                     'taxes' => $rate->taxes,
    //                     'description' => json_decode($rate->description, true) ?? [],
    //                     'cancellationPolicy' => $rate->cancellation_policy ?? 'Non-Refundable',
    //                 ];
                
    //             }),
    //             'amenities' => $amenities,
    //         ];
    //     });
    //     return response()->json(['data' => $roomsData], 200);
    // }

    // public function hotelDetails(Request $request)
    // {
    //     $start_date = Carbon::parse($request->input('start_date'));
    //     $end_date = Carbon::parse($request->input('end_date'));
    //     $user = Auth::user();
    
    //     $id = $request->query('id');
    //     $hotel = Hotel::with([
    //         'rooms',
    //         'rooms.RoomType', // Fetch RoomType for each room
    //         'rooms.rates',    // Fetch Rates for each room
    //     ])->find($id);
    
    //     if (!$hotel) {
    //         return response()->json(['message' => 'Hotel details not found'], 404);
    //     }
    
    //     // Fetch blackout and fair dates only once
    //     $blackDates = $this->generateDateRangeFromRates('blackout', $start_date, $end_date);
    //     $fairDates = $this->generateDateRangeFromRates('fair', $start_date, $end_date);
    
    //     // Process rooms
    //     $roomsData = $hotel->rooms->map(function ($room) use ($user, $blackDates, $fairDates, $start_date, $end_date) {
    //         // Get weekend days for the room
    //         $weekendDays = json_decode($room->weekend_days, true) ?? [];
            
    //         if($room->rates->event_type === 'Blackout Date'){
    //             // Check if the room has blackout or fair dates
    //             $roomBlackDates = $this->generateDateRangeFromRates('blackout', $start_date, $end_date);
    //         }
            
    //         $roomFairDates = $this->generateDateRangeFromRates('fair', $start_date, $end_date);
    
    //         // Calculate room price
    //         $roomPrice = $this->calculateRoomPrice($room, $weekendDays, $user);
    
    //         // Check if the room falls under blackout or fair dates
    //         $isBlackout = $roomBlackDates->intersect($blackDates)->isNotEmpty();
    //         $isFair = $roomFairDates->intersect($fairDates)->isNotEmpty();
    
    //         // Prepare room amenities and options
    //         $roomAmenities = $room->RoomType->facilities ?? [];
    //         $roomOptions = $room->rates->map(function ($rate) {
    //             return [
    //                 'id' => $rate->id,
    //                 'title' => $rate->title ?? $rate->name,
    //                 'price' => $rate->price,
    //                 'taxes' => $rate->taxes,
    //                 'description' => json_decode($rate->description, true) ?? [],
    //                 'cancellationPolicy' => $rate->cancellation_policy ?? 'Non-Refundable',
    //             ];
    //         });
    
    //         // Return formatted room data based on blackout or fair dates
    //         return [
    //             'type' => $room->RoomType->name ?? 'Unknown Room Type',
    //             'title' => $room->RoomType->name ?? 'Unknown Room Type',
    //             'image' => $room->image ?? 'default-image-url.jpg',
    //             'photosCount' => $room->photos_count ?? 0,
    //             'features' => [
    //                 'size' => $room->size ?? 'Unknown Size',
    //                 'bed' => $room->bed ?? 'Unknown Bed',
    //                 'maxGuests' => $room->max_guests ?? 'Unknown Guests',
    //             ],
    //             'aboutRoom' => $room->about ?? 'No description available.',
    //             'amenities' => $roomAmenities,
    //             'roomOptions' => $roomOptions->toArray(),
    //             'roomPrice' => $roomPrice, // Include calculated room price
    //             'isBlackout' => $isBlackout,
    //             'isFair' => $isFair,
    //         ];
    //     });
    
    //     return response()->json(['data' => $roomsData], 200);
    // }

    // /**
    //  * Generate a collection of dates from the rates table based on the event name.
    //  */
    // private function generateDateRangeFromRates(string $eventName, $start_date, $end_date)
    // {
    //     $rates = DB::table('rates')
    //         ->where('event_type', $eventName)
    //         ->whereBetween('start_date', [$start_date, $end_date])
    //         ->orWhereBetween('end_date', [$start_date, $end_date])
    //         ->get(['start_date', 'end_date']);

    //     $dates = collect();
    //     foreach ($rates as $rate) {
    //         $rangeStart = Carbon::parse($rate->start_date);
    //         $rangeEnd = Carbon::parse($rate->end_date);
    //         for ($date = $rangeStart; $date->lte($rangeEnd); $date->addDay()) {
    //             $dates->push($date->toDateString());
    //         }
    //     }

    //     return $dates;
    // }

    // /**
    //  * Calculate room price based on user type and weekend days.
    //  */
    // private function calculateRoomPrice($room, array $weekendDays, $user)
    // {
    //     $currentDay = now()->format('l');

    //     switch ($user->user_type) {
    //         case 2: // Logic for user_type 2
    //             if (in_array($currentDay, $weekendDays)) {
    //                 return $room->weekend_price;
    //             }
    //             return $room->weekday_price;

    //         case 1: // Logic for user_type 1
    //         case 3: // Logic for user_type 3
    //         default:
    //             return $room->weekday_price; // Default to weekday price for other user types
    //     }
    // }

    
}



