<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserRegister extends Component
{
    public $name;
    public $email;
    public $password;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,$this->rules);
    }

    public function resetForm()
    {
        $this->name='';
        $this->email='';
        $this->password='';
    }

    public function create()
    {
        $fields=[
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>$this->password,
        ];
        $this->validate($this->rules,[],$fields);
        $fields['password']=Hash::make($this->password);
        User::create($fields);
        $this->resetForm();
        $this->emit('refresh');

    }

    public function render()
    {
        return view('livewire.user-register');
    }
}
