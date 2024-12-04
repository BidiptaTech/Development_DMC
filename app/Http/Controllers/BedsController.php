<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Facility;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\CommonHelper;

class BedsController extends Controller
{
    /*
    * Display a listing of the Category.
    * Date 06-11-2024
    */
    public function index(Request $request)
    {
        $beds = Bed::all();
        // Decode the category names to ensure no HTML entities or special characters are escaped
        return view('beds.beds', compact('beds'));
    }

    /*
    * Show the form for creating a new category.
    * Date 06-11-2024
    */
    public function create()
    {
        return view('beds.add-beds');
    }

    /*
    * Store a newly created role.
    * Date 07-10-2024
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'bed_type' => 'required|unique:roles,name',
            'image' => 'required',
            'description' => 'required',
        ]);

        $image = $request->file('image');
        $storage_file = CommonHelper::image_path('file_storage', $image);

        $bed_max_id = Bed::max('bedId') ?? 0;
        $bedId = CommonHelper::createId($bed_max_id);
        while (Bed::where('bedId', $bedId)->exists()) {
            $bedId = CommonHelper::createId($bedId);
        }
        $bed = Bed::create([
            'bedId' => $bedId,
            'bed_type' => $request->input(key: 'bed_type'),
            'image' => $storage_file['master_value'],
            'description'=> $request->input('description'),
        ]);
        return redirect()->route('beds.index')
            ->with('success', 'Bed type created successfully');
    }

    /*
    * Show the form fors editing the specified role.
    * Date 07-10-2024
    */
    public function edit($id)
    {
        $bed = Bed::where('bedId',$id)->first();
        return view('beds.edit-beds', compact('bed'));
    }
    /*
    * Update the specified role.
    * Date 07-10-2024
    */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $bed = Bed::where('bedId',$id)->first();
        //image upload using helper
        $image = $request->file('image');
        if($image){
        $storage_file = CommonHelper::image_path('file_storage', $image);
        }
        $bed->bed_type = $request->input('bed_type');
        $bed->image = $storage_file['master_value'] ?? $bed->image;
        $bed->description = $request->input('description');
        $bed->save();

        return redirect()->route('beds.index')->with('success', 'Bed Type updated successfully.');
    }

    /*
    * Soft Delete Roles.
    * Date 07-10-2024
    */
    public function destroy($id)
    {
        $bed = Bed::where('bedId',$id)->first();

        if($bed){
            $bed->delete();
            return redirect()->route('beds.index')
            ->with('success','Bed Type deleted successfully');
        }
        else{
            return redirect()->route(route: 'category.index')
            ->with('denied','Either cannot delete or bed type not found!');
        }
        
    }

}
