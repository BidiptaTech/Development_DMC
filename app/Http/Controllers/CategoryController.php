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
use App\Helpers\CommonHelper;

class CategoryController extends Controller
{
    /*
    * Display a listing of the Category.
    * Date 06-11-2024
    */
    public function index(Request $request)
    {
        $categories = Category::where('status', 1)->orderBy('id', 'desc')->get();
        // Decode the category names to ensure no HTML entities or special characters are escaped
        
       
        return view('category.index', compact('categories'));
    }

    /*
    * Show the form for creating a new category.
    * Date 06-11-2024
    */
    public function create()
    {
        return view('category.create');
    }

    /*
    * Store a newly created role.
    * Date 07-10-2024
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'category_type' => 'required',
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

    /*
    * Show the form fors editing the specified role.
    * Date 07-10-2024
    */
    public function edit($id)
    {
        $category = Category::where('id',$id)->first();
        return view('category.edit', compact('category'));
    }
    /*
    * Update the specified role.
    * Date 07-10-2024
    */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $category = Category::where('id',$id)->first();
        //image upload using helper
        $image = $request->file('icon');
        if($image){
        $storage_file = CommonHelper::image_path('file_storage', $image);
        }
        $category->name = $request->input('name');
        $category->category_type = $request->input('category_type');
        $category->status = $request->input('category_status');
        $category->icon = $storage_file['master_value'] ?? $category->icon;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Categories updated successfully.');
    }

    /*
    * Soft Delete Roles.
    * Date 07-10-2024
    */
    public function destroy($id)
    {
        $facility = Facility::where('category_id',$id)->get();

        if(count($facility) == 0){
            $delete =Category::where('id', $id)->delete();
            return redirect()->route('category.index')
            ->with('success','Category deleted successfully');
        }
        else{
            return redirect()->route(route: 'category.index')
            ->with('denied','This Category is in use, Cannot be delete!');
        }
        
    
    }

}
