<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Exception;

class ProductController extends Controller
{
    private $rules=[
        'name'=>'required|string',
        'price'=>'required|numeric',
        'category_id'=>'required',
        'description'=>'nullable|string',
    ];

    public function index()
    {
        return view('products.list');
    }

    public function create()
    {
        return view('products.form',['productForEdit'=>null,'categories'=>Category::all()]);
    }

    public function store()
    {
        $rules=$this->rules;
        $rules['name'] .= '|unique:products';
        \request()->validate($rules);
        try {
            Product::create($this->getFields(\request()));
            session()->flash('message','Uspesno');
            session()->flash('alert-type','success');
        }catch (Exception $e){
            session()->flash('message',$e->getMessage());
            session()->flash('alert-type','error');
        }
        return Redirect::route('productsList');
    }

    public function edit(Product $product)
    {
        return view('products.form',['productForEdit'=>$product,'categories'=>Category::all()]);
    }

    public function update(Product $product)
    {
        \request()->validate($this->rules);
        try {
            $product->update($this->getFields(\request()));
            session()->flash('message','Uspesno');
            session()->flash('alert-type','success');
        }catch (Exception $e){
            session()->flash('message',$e->getMessage());
            session()->flash('alert-type','error');
        }
        return Redirect::route('productsList');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        \session()->flash('alert-type','success');
        \session()->flash('message','Uspesno');
        return Redirect::route('productsList');
    }
}
