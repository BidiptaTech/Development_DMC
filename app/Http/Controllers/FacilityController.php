<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Facility;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FacilityController extends Controller
{
    /*
    * Display a listing of the Category.
    * Date 06-11-2024
    */
    public function index(Request $request)
    {
        $facilities = Facility::orderBy('id', 'desc')->get();
        return view('facility.facility',compact('facilities'));
    }

    /*
    * Show the form for creating a new category.
    * Date 06-11-2024
    */
    public function create()
    {
        $facilityIcons  = [
            'bi-wifi' => 'WiFi',
            'bi-water' => 'Pool',
            'bi-spa' => 'Spa',
            'bi-house' => 'Hotel',
            'bi-cone-striped' => 'Construction',
            'bi-tree' => 'Garden',
            'bi-lightning' => 'Electricity',
            'bi-bicycle' => 'Bike Facility',
            'bi-car-front' => 'Parking',
            'bi-door-closed' => 'Private Entrance',
            // Add more Bootstrap icons as needed
        ];
        $categories = Category::where('category_type', 2)->get();
        return view('facility.add-facility', compact('categories', 'facilityIcons'));
    }

    /*
    * Store a newly created role.
    * Date 07-10-2024
    */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $this->validate($request, [
            'name' => 'required',
            'category_type' => 'required',
            'status' => 'required',
        ]);
    
        // Check if a facility with the same name and category already exists
        $existingFacility = Facility::where('name', $request->input('name'))
            ->where('category_id', $request->input('category_type'))
            ->first();
    
        if ($existingFacility) {
            // If the facility already exists, redirect with an error message
            return redirect()->back()
                ->with('error', 'Facility with this name and category already exists.');
        }
    
        // If no existing facility found, create the new facility
        $facility = Facility::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_type'),
            'icon' => $request->input('icon'),
            'status' => $request->input('status'),
        ]);
    
        // Redirect to the index page with a success message
        return redirect()->route('facility.index')
            ->with('success', 'Facility created successfully');
    }
    

    /*
    * Show the form for editing the specified role.
    * Date 07-10-2024
    */
    public function edit($id)
    {

        $facility = Facility::where('id',$id)->first();
        $categories = Category::all();
        $currentCategory = Category::where('id',$facility->category_id)->first();

        $facilityIcons  = [
            'bi-wifi' => 'WiFi',
            'bi-water' => 'Pool',
            'bi-spa' => 'Spa',
            'bi-house' => 'Hotel',
            'bi-cone-striped' => 'Construction',
            'bi-tree' => 'Garden',
            'bi-lightning' => 'Electricity',
            'bi-bicycle' => 'Bike Facility',
            'bi-car-front' => 'Parking',
            'bi-door-closed' => 'Private Entrance',
            // Add more Bootstrap icons as needed
        ];
        return view('facility.edit-facility', compact('facility', 'categories', 'currentCategory', 'facilityIcons'));
    }
    /*
    * Update the specified role.
    * Date 07-10-2024
    */
    public function update(Request $request, $id)
    {
        $facility = Facility::where('id',$id)->first();
        $facility->name = $request->input('name');
        $facility->category_id = $request->input('category_type');
        $facility->status = $request->input('status');
        $facility->icon = $request->input('icon');
        $facility->save();

        return redirect()->route('facility.index')->with('success', 'Facility updated successfully.');
    }

    /*
    * Soft Delete Roles.
    * Date 07-10-2024
    */
    public function destroy($id)
    {  
        $delete =Facility::where('id', $id)->delete();
        return redirect()->route('facility.index')
        ->with('success','Facility deleted successfully');
    
    }
}
