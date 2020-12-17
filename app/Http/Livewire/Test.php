<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Test extends Component
{
    public $modalVisible = false;
    public $userData = [
        'type' => "1"
    ];
    public $userId;

    public function rules()
    {
        $rules = [
            'userData.name' => 'required',
            'userData.email' => 'required' ,
        ];
        return $rules;
    }

    public function create()
    {
        
        $this->reset();
        $this->modalVisible = true;
    }

    public function store()
    {
        // dd($this->roleId);
        $this->validate();
        $this->userData['password'] = bcrypt('123456');
        User::create($this->userData);
        $this->modalVisible = false;
        session()->flash('message','Created successfully !!!');
    }

    public function show($id)
    {
        $this->resetValidation();
        $this->userId = $id;
        $this->userData = User::find($this->userId)->toArray();
        $this->modalVisible = true;
        
    }

    public function update()
    {
        User::find($this->userId)->update($this->userData);
        $this->modalVisible = false;
        session()->flash('message','Updated successfully !!!');
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message','Deleted successfully !!!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.test', [
            'users' => User::paginate(5) , 
        ]);
    }
}
