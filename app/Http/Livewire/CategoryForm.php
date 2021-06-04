<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryForm extends Component
{
    public $categoryForEdit=null;
    public $name;
    public $edit=false;


    public function mount($categoryForEdit)
    {
        if($categoryForEdit)
        {
            $categoryForEdit=Category::where('id',$categoryForEdit)->first();
            $this->categoryForEdit=$categoryForEdit;
            $this->name=$categoryForEdit->name;
            $this->edit=true;
        }

    }

    protected $rules = [
        'name'=>'string|required',
    ];

    protected $listeners=[
        'refresh'=>'$refresh'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,$this->rules);
    }

    public function edit()
    {
        $fields=[
            'name'=>$this->name,
        ];
        $this->validate($this->rules,[],$fields);
        try {
            if($this->edit)
                $this->categoryForEdit->update($fields);
            else
                Category::create($fields);
        }catch (\Exception $e)
        {
            session()->flash('message','Greska');
            session()->flash('alert-type','error');
            return;
        }

        session()->flash('message','Uspesno');
        session()->flash('alert-type','success');

        $this->redirectRoute('categoriesList');
    }

    public function render()
    {
        return view('livewire.category-form');
    }
}
