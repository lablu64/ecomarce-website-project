<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function Index(){
        $allsubcategories =SubCategory::latest()->get();
        return view('admin.allsubcategory',compact('allsubcategories'));
    }

    public function AddSubCategory(){
        $categories = Category::latest()->get();
        return view('admin.addsubcategory',compact('categories'));
    }
    
    public function StoreSubCategory(Request $request){
        $request->validate([
            'subcategory_name' => 'required|unique:sub_categories|max:255',
            'category_id' => 'required',
            
        ]);
        $category_id = $request->category_id;
        $category_name =Category::where('id',$category_id)->value('category_name');
       
        SubCategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ','-',$request->subcategory_name)),
            'category_id' => $category_id,
            'category_name' => $category_name,

        ]);
        Category::where('id', $category_id)->increment('subcategory_count', 1);
        return redirect()->route('allsubcategory')->with('message','Sub category added successfully !');
   
    }

    public function EditSubCate($id){
        $subcateinfo =SubCategory::findOrFail($id);
        return view('admin.editsubcategory',compact('subcateinfo'));
    }

    public function UpdateSubCat(Request $request){
        $request->validate([
            'subcategory_name' => 'required|unique:sub_categories|max:255',

        ]);
        $subcateid = $request->subcateid;
       
        SubCategory::findOrFail( $subcateid)->update([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ','-',$request->subcategory_name)),
    

        ]);
        // Category::where('id', $category_id)->increment('subcategory_count', 1);
        return redirect()->route('allsubcategory')->with('message','Sub category updated successfully !');
   

    }

    public function DeleteSubCate($id){
        $cate_id = SubCategory::where('id',$id)->value('category_id');
        SubCategory::findOrFail( $id)->delete();
        Category::where('id',$cate_id)->decrement('subcategory_count', 1);
        return redirect()->route('allsubcategory')->with('message','Sub category deleted successfully !');

    }
}
