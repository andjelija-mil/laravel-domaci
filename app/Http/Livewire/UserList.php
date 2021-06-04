<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
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


    protected $listeners=[
        'refresh'=>'$refresh'
    ];

    public function render()
    {
        return view('livewire.user-list',[
            'users'=>User::where(function ($query){
                $query->where('id','like','%'.$this->search.'%')
                    ->orWhere('name','like','%'.$this->search.'%')
                    ->orWhere('email','like','%'.$this->search.'%');
            })->when($this->sortField,function ($query){
                $query->orderBy($this->sortField,$this->sortAsc ? 'asc' : 'desc');
            })->paginate(5),
        ]);
    }
}
