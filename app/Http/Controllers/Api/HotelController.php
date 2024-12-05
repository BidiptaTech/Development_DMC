<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Category;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    /*
    * Show Hotel Listings.
    * Date 06-11-2024
    */
    public function index(Request $request)
    {
        $cat_id = $request->category_id;
        if($cat_id){
            $hotels = Hotel::where('status', 1)->where('cat_id',$cat_id)
            ->orderBy('id','desc')
            ->get();
        }else{
            $hotels = Hotel::where('status', 1)
            ->orderBy('id','desc')
            ->get();
        }
        
        $hotel_list = [];
        if ($hotels->count() > 0) {
            foreach ($hotels as $hotel) {
                $hotel_list[] = [
                    'id' => $hotel->id,
                    'hotel_name' => $hotel->name,
                    'location' => $hotel->location,
                    'rating' => $hotel->rating,
                    'price' => 5000,
                    'image' => $hotel->image ?? '',
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
    // public function details(Request $request)
    // {
    //     $tax = Setting::where('name', 'tax_percentage')->first();
    //     $tax_percentage = $tax ? $tax->value : 0;

    //     $id = $request->query('id');
    //     $hotel_details = RoomRate::where('hotel_id', $id)->get();

    //     if ($hotel_details->isEmpty()) {
    //         return response()->json([
    //             'message' => 'No hotels found'
    //         ], 404);
    //     }

    //     $room_details = [];
    //     foreach ($hotel_details as $room) {
    //         $days = $room->rate_type == 1 ? "Week Day" : "Weekend";
    //         switch ($room->room_type) {
    //             case 1:
    //                 $room_type = "Single Room";
    //                 $base_price = $room->single_rate;
    //                 break;
    //             case 2:
    //                 $room_type = "Double Room";
    //                 $base_price = $room->double_rate;
    //                 break;
    //             case 3:
    //                 $room_type = "Triple Room";
    //                 $base_price = $room->triple_rate;
    //                 break;
    //             default:
    //                 $room_type = "Unknown";
    //                 $base_price = 0;
    //                 break;
    //         }

    //         $room_rates[] = [
    //             'room_only' => [
    //                 'price' => $base_price,
    //                 'tax_price' => ($base_price * $tax_percentage) / 100,
    //                 'total_price' => $base_price + (($base_price * $tax_percentage) / 100)
    //             ],
    //             'room_with_breakfast' => [
    //                 'price' => $base_price + ($room->breakfast ?? 0),
    //                 'tax_price' => (($base_price + ($room->breakfast ?? 0)) * $tax_percentage) / 100,
    //                 'total_price' => ($base_price + ($room->breakfast ?? 0)) + ((($base_price + ($room->breakfast ?? 0)) * $tax_percentage) / 100)
    //             ],
    //             'room_with_lunch' => [
    //                 'price' => $base_price + ($room->lunch ?? 0),
    //                 'tax_price' => (($base_price + ($room->lunch ?? 0)) * $tax_percentage) / 100,
    //                 'total_price' => ($base_price + ($room->lunch ?? 0)) + ((($base_price + ($room->lunch ?? 0)) * $tax_percentage) / 100)
    //             ],
    //             'room_with_dinner' => [
    //                 'price' => $base_price + ($room->dinner ?? 0),
    //                 'tax_price' => (($base_price + ($room->dinner ?? 0)) * $tax_percentage) / 100,
    //                 'total_price' => ($base_price + ($room->dinner ?? 0)) + ((($base_price + ($room->dinner ?? 0)) * $tax_percentage) / 100)
    //             ],
    //             'room_with_extrabed' => [
    //                 'price' => $base_price + ($room->extra_bed ?? 0),
    //                 'tax_price' => (($base_price + ($room->extra_bed ?? 0)) * $tax_percentage) / 100,
    //                 'total_price' => ($base_price + ($room->extra_bed ?? 0)) + ((($base_price + ($room->extra_bed ?? 0)) * $tax_percentage) / 100)
    //             ],
    //         ];

    //         $room_details[] = [
    //             'id' => $room->id,
    //             'hotel_id' =>$id,
    //             'category' => $room->category ?? '',
    //             'room_type' => $room_type,
    //             'rate_type' => $days,
    //             'kids_below_6' => $room->kids_below_6 ?? '',
    //             'kids_above_6' => $room->kids_above_6 ?? '',
    //             'breakfast_kids_below_6' => $room->breakfast_kids_below_6 ?? '',
    //             'lunch_kids_below_6' => $room->lunch_kids_below_6 ?? '',
    //             'dinner_kids_below_6' => $room->dinner_kids_below_6 ?? '',
    //             'room_rates' => $room_rates,
    //         ];
    //     }

    //     return response()->json($room_details);
    // }

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

    /*Search hotel with location*/
    public function location(Request $request)
    {
        $location = $request->query('location');
        // Fetch hotels matching the location
        $hotels = Hotel::where('city', $location)->get();

        // If no hotels are found, return a 404 response
        if ($hotels->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => "No hotels found in the location: $location",
            ], 404);
        }

        // Process hotel details
        $hotelDetails = $hotels->map(function ($hotel) {
            // Fetch the category for the hotel
            $category = Category::find($hotel->cat_id);

            // Decode facilities JSON (handle null or empty cases)
            $facilityIds = json_decode($hotel->facilities, true) ?? [];

            // Fetch related facilities
            $relatedFacilities = Facility::whereIn('id', $facilityIds)->get();

            return [
                'id' => $hotel->id,
                'name' => $hotel->name,
                'location' => $hotel->city,
                'star' => $category ? $category->name : 'Unknown', // Handle missing category
                'image'=>$hotel->main_image ?? '',
                'amenities' => $relatedFacilities->map(function ($amenity) {
                    return [
                        'id' => $amenity->id,
                        'amenityName' => $amenity->name,
                    ];
                }),
                'price' => 5000, // Replace with actual pricing logic if needed
                // 'images' => $images ?: [], 
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $hotelDetails,
        ],200, [], JSON_UNESCAPED_UNICODE);
    }




    public function hotelDetails(Request $request)
    {
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
        $user = Auth::user();
    
        $id = $request->query('id');
        $hotel = Hotel::with([
            'rooms',
            'rooms.RoomType', // Fetch RoomType for each room
            'rooms.rates',    // Fetch Rates for each room
        ])->find($id);
    
        if (!$hotel) {
            return response()->json(['message' => 'Hotel details not found'], 404);
        }
    
        // Fetch blackout and fair dates only once
        $blackDates = $this->generateDateRangeFromRates('blackout', $start_date, $end_date);
        $fairDates = $this->generateDateRangeFromRates('fair', $start_date, $end_date);
    
        // Process rooms
        $roomsData = $hotel->rooms->map(function ($room) use ($user, $blackDates, $fairDates, $start_date, $end_date) {
            // Get weekend days for the room
            $weekendDays = json_decode($room->weekend_days, true) ?? [];
    
            // Check if the room has blackout or fair dates
            $roomBlackDates = $this->generateDateRangeFromRates('blackout', $start_date, $end_date);
            $roomFairDates = $this->generateDateRangeFromRates('fair', $start_date, $end_date);
    
            // Calculate room price
            $roomPrice = $this->calculateRoomPrice($room, $weekendDays, $user);
    
            // Check if the room falls under blackout or fair dates
            $isBlackout = $roomBlackDates->intersect($blackDates)->isNotEmpty();
            $isFair = $roomFairDates->intersect($fairDates)->isNotEmpty();
    
            // Prepare room amenities and options
            $roomAmenities = $room->RoomType->facilities ?? [];
            $roomOptions = $room->rates->map(function ($rate) {
                return [
                    'id' => $rate->id,
                    'title' => $rate->title ?? $rate->name,
                    'price' => $rate->price,
                    'taxes' => $rate->taxes,
                    'description' => json_decode($rate->description, true) ?? [],
                    'cancellationPolicy' => $rate->cancellation_policy ?? 'Non-Refundable',
                ];
            });
    
            // Return formatted room data based on blackout or fair dates
            return [
                'type' => $room->RoomType->name ?? 'Unknown Room Type',
                'title' => $room->RoomType->name ?? 'Unknown Room Type',
                'image' => $room->image ?? 'default-image-url.jpg',
                'photosCount' => $room->photos_count ?? 0,
                'features' => [
                    'size' => $room->size ?? 'Unknown Size',
                    'bed' => $room->bed ?? 'Unknown Bed',
                    'maxGuests' => $room->max_guests ?? 'Unknown Guests',
                ],
                'aboutRoom' => $room->about ?? 'No description available.',
                'amenities' => $roomAmenities,
                'roomOptions' => $roomOptions->toArray(),
                'roomPrice' => $roomPrice, // Include calculated room price
                'isBlackout' => $isBlackout,
                'isFair' => $isFair,
            ];
        });
    
        return response()->json(['data' => $roomsData], 200);
    }
    

/**
 * Generate a collection of dates from the rates table based on the event name.
 */
private function generateDateRangeFromRates(string $eventName, $start_date, $end_date)
{
    $rates = DB::table('rates')
        ->where('event_type', $eventName)
        ->whereBetween('start_date', [$start_date, $end_date])
        ->orWhereBetween('end_date', [$start_date, $end_date])
        ->get(['start_date', 'end_date']);

    $dates = collect();
    foreach ($rates as $rate) {
        $rangeStart = Carbon::parse($rate->start_date);
        $rangeEnd = Carbon::parse($rate->end_date);
        for ($date = $rangeStart; $date->lte($rangeEnd); $date->addDay()) {
            $dates->push($date->toDateString());
        }
    }

    return $dates;
}

/**
 * Calculate room price based on user type and weekend days.
 */
private function calculateRoomPrice($room, array $weekendDays, $user)
{
    $currentDay = now()->format('l');

    switch ($user->user_type) {
        case 2: // Logic for user_type 2
            if (in_array($currentDay, $weekendDays)) {
                return $room->weekend_price;
            }
            return $room->weekday_price;

        case 1: // Logic for user_type 1
        case 3: // Logic for user_type 3
        default:
            return $room->weekday_price; // Default to weekday price for other user types
    }
}

    
}



