<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\SubSubCategory;

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


    /////sub sub category/////

    public function SubSubCategoryView()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subsubcategory = SubSubCategory::latest()->get();

        return view('backend.category.sub_subcategory_view', compact('subsubcategory', 'categories'));
    }

    public function GetSubCategory($category_id)
    {
        $subcat = Subcategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcat);
    }

    public function SubSubCategoryStore(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_hin' => 'required',
        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_hin' => $request->subsubcategory_name_hin,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '_', $request->subsubcategory_name_en)),
            'subsubcategory_slug_hin' => str_replace(' ', '_', $request->subsubcategory_name_hin),

        ]);

        $notification = array(
            'message' => 'Sub-SubCategory Inserted Successfully!',
            'alert-type' => 'success',

        );
        return redirect()->back()->with($notification);
    }
}
