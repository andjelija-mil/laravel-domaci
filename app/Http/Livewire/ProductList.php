<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $search;
    public $sortField;
    public $sortAsc=true;
    protected $paginationTheme='bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {

        if($this->sortField===$field)
        {
            $this->sortAsc = !$this->sortAsc;
        }
        else
            $this->sortAsc=true;

        $this->sortField=$field;
    }

    public function render()
    {
        return view('livewire.product-list',[
            'products'=>Product::join('categories','products.category_id','=','categories.id')
                ->select('*','products.id as pid','products.name as pname','categories.name as cname')
                ->where(function ($query){
                    $query->where('products.id','like','%'.$this->search.'%')
                        ->orWhere('products.name','like','%'.$this->search.'%')
                        ->orWhere('products.price','like','%'.$this->search.'%')
                        ->orWhere('products.description','like','%'.$this->search.'%')
                        ->orWhere('categories.name','like','%'.$this->search.'%');
                })->when($this->sortField,function ($query){
                    $query->orderBy($this->sortField,$this->sortAsc ? 'asc' : 'desc');
                })->paginate(5)
        ]);
    }
}
