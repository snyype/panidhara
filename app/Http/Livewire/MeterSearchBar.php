<?php

namespace App\Http\Livewire;

use App\Models\Meter;
use Livewire\Component;

class MeterSearchBar extends Component
{
    public $query;
    public $meters;
    

    public function mount()
    {
       $this->reset();

    }

    public function resetData()
    {
        $this->query = '';
        $this->meters = [];

    }




    public function updatedQuery()
    {

        $this->meters = Meter::where('name','like','%'.$this->query.'%')->orwhere('meter_number',$this->query)->get()->toArray();
    }

    public function render()
    {
        return view('livewire.meter-search-bar');
    }
}
