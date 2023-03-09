<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Monitor extends Component
{
    public $categories;

    public $users;

    public $size;

    public function render()
    {
        return view('livewire.monitor');
    }
}
