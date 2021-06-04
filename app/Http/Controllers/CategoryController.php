<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.list',['categoryForEdit'=>null]);
    }

    public function edit($category)
    {
        return view('categories.list',['categoryForEdit'=>$category]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        \session()->flash('alert-type','success');
        \session()->flash('message','Uspesno');
        return Redirect::route('categoriesList');
    }
}
