<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserSearchBar extends Component
{
    public $query;
    public $users;

    public function mount()
    {
       $this->reset();

    }

    public function resetData()
    {
        $this->query = '';
        $this->users = [];

    }

    public function updatedQuery()
    {
        sleep(1);

        $this->users = User::where('name','like','%'.$this->query.'%')->orwhere('email',$this->query)->orwhere('number',$this->query)->get()->toArray();
    }

    public function render()
    {
        return view('livewire.user-search-bar');
    }
}
