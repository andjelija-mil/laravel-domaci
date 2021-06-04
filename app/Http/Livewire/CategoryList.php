<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryList extends Component
{
    use WithPagination;

    public $search;
    public $sortField;
    public $sortAsc=true;
    public $active=true;

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
        return view('livewire.category-list',[
            'categories'=>Category::where(function ($query){
                $query->where('id','like','%'.$this->search.'%')
                    ->orWhere('name','like','%'.$this->search.'%');
            })->when($this->sortField,function ($query){
                $query->orderBy($this->sortField,$this->sortAsc ? 'asc' : 'desc');
            })->paginate(5)
        ]);
    }
}
