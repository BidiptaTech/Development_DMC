<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\RoomRate;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;

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
    public function details(Request $request)
    {
        $tax = Setting::where('name', 'tax_percentage')->first();
        $tax_percentage = $tax ? $tax->value : 0;

        $id = $request->id;
        $hotel_details = RoomRate::where('hotel_id', $id)->get();

        if ($hotel_details->isEmpty()) {
            return response()->json([
                'message' => 'No hotels found'
            ], 404);
        }

        $room_details = [];
        foreach ($hotel_details as $room) {
            $days = $room->rate_type == 1 ? "Week Day" : "Weekend";
            switch ($room->room_type) {
                case 1:
                    $room_type = "Single Room";
                    $base_price = $room->single_rate;
                    break;
                case 2:
                    $room_type = "Double Room";
                    $base_price = $room->double_rate;
                    break;
                case 3:
                    $room_type = "Triple Room";
                    $base_price = $room->triple_rate;
                    break;
                default:
                    $room_type = "Unknown";
                    $base_price = 0;
                    break;
            }

            $room_rates[] = [
                'room_only' => [
                    'price' => $base_price,
                    'tax_price' => ($base_price * $tax_percentage) / 100,
                    'total_price' => $base_price + (($base_price * $tax_percentage) / 100)
                ],
                'room_with_breakfast' => [
                    'price' => $base_price + ($room->breakfast ?? 0),
                    'tax_price' => (($base_price + ($room->breakfast ?? 0)) * $tax_percentage) / 100,
                    'total_price' => ($base_price + ($room->breakfast ?? 0)) + ((($base_price + ($room->breakfast ?? 0)) * $tax_percentage) / 100)
                ],
                'room_with_lunch' => [
                    'price' => $base_price + ($room->lunch ?? 0),
                    'tax_price' => (($base_price + ($room->lunch ?? 0)) * $tax_percentage) / 100,
                    'total_price' => ($base_price + ($room->lunch ?? 0)) + ((($base_price + ($room->lunch ?? 0)) * $tax_percentage) / 100)
                ],
                'room_with_dinner' => [
                    'price' => $base_price + ($room->dinner ?? 0),
                    'tax_price' => (($base_price + ($room->dinner ?? 0)) * $tax_percentage) / 100,
                    'total_price' => ($base_price + ($room->dinner ?? 0)) + ((($base_price + ($room->dinner ?? 0)) * $tax_percentage) / 100)
                ],
                'room_with_extrabed' => [
                    'price' => $base_price + ($room->extra_bed ?? 0),
                    'tax_price' => (($base_price + ($room->extra_bed ?? 0)) * $tax_percentage) / 100,
                    'total_price' => ($base_price + ($room->extra_bed ?? 0)) + ((($base_price + ($room->extra_bed ?? 0)) * $tax_percentage) / 100)
                ],
            ];

            $room_details[] = [
                'id' => $room->id,
                'hotel_id' =>$id,
                'category' => $room->category ?? '',
                'room_type' => $room_type,
                'rate_type' => $days,
                'kids_below_6' => $room->kids_below_6 ?? '',
                'kids_above_6' => $room->kids_above_6 ?? '',
                'breakfast_kids_below_6' => $room->breakfast_kids_below_6 ?? '',
                'lunch_kids_below_6' => $room->lunch_kids_below_6 ?? '',
                'dinner_kids_below_6' => $room->dinner_kids_below_6 ?? '',
                'room_rates' => $room_rates,
            ];
        }

        return response()->json($room_details);
    }

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
    public function facilities()
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

            // Decode images JSON if it's a JSON column
            $images = is_string($hotel->images) ? json_decode($hotel->images, true) : $hotel->images;

            return [
                'id' => $hotel->id,
                'name' => $hotel->name,
                'location' => $hotel->city,
                'star' => $category ? $category->name : 'Unknown', // Handle missing category
                'amenities' => $relatedFacilities->map(function ($amenity) {
                    return [
                        'id' => $amenity->id,
                        'amenityName' => $amenity->name,
                    ];
                }),
                'price' => 5000, // Replace with actual pricing logic if needed
                'images' => $images ?: [], // Default to an empty array if images are null
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $hotelDetails,
        ],200, [], JSON_UNESCAPED_UNICODE);
    }
}



