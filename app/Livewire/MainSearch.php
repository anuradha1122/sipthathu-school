<?php

namespace App\Livewire;

use Livewire\Component;

class MainSearch extends Component
{
    public $searchResults = null;

    public function render()
    {
        return view('livewire.main-search');
    }
}
