<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('rolechecker');
  }


    function categoryaddview(){
    $categories=  Category::paginate(10);
      return view('category/view',compact('categories'));
    }
    function categoryaddinsert(Request $request){
      $request->validate([
        'category_name'=> 'required',


      ],
        [
          'category_name.required'=>'Category Name Must Need!',
        ]);

      Category::insert([
        'category_name' => $request->category_name,
        'created_at'=>Carbon::now()

      ]);
      return back();
    }
    function categorydelete($category_id)
    {
      Category::find($category_id)->delete();

      return back()->with('status', 'Category Deleted Successfully!');
    }
}
