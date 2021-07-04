<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;

class SubcategoryController extends Controller
{
    public function SubcategoryView()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategory = Subcategory::latest()->get();
        return view('backend.category.subcategory_view', compact('subcategory', 'categories'));
    }

    public function SubcategoryStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_hin' => 'required',
        ]);

        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_hin' => $request->subcategory_name_hin,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_hin' => str_replace(' ', '-', $request->subcategory_name_hin),
        ]);

        $notification = array(
            'message' => 'Subcategory Inserted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function SubcategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategory = Subcategory::findOrFail($id)->update();
        return view('backend.category.subcategory_edit', compact('subcategory', 'categories'));
    }

    public function SubcategoryUpdate(Request $request)
    {
        $subcat_id = $request->id;

        Subcategory::findOrFail($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_hin' => $request->subcategory_name_hin,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_hin' => str_replace(' ', '-', $request->subcategory_name_hin),
        ]);

        $notification = array(
            'message' => 'Subcategory Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    }

    public function SubcategoryDelete($id)
    {
        Subcategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Subcategory Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    }
}
