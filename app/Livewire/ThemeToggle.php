<?php

namespace App\Livewire;

use Livewire\Component;

class ThemeToggle extends Component
{
    public $darkMode = false;

    public function mount()
    {
        // Check for existing preference in session or cookie
        $this->darkMode = session()->get('darkMode', 
            request()->cookie('darkMode', false)
        );
    }

    public function toggle()
    {
        $this->darkMode = !$this->darkMode;
        
        // Store preference
        session()->put('darkMode', $this->darkMode);
        cookie()->queue('darkMode', $this->darkMode, 60*24*365); // 1 year
        
        // For Livewire v3.x
        $this->dispatch('themeChanged', darkMode: $this->darkMode);
    }


    public function render()
    {
        return view('livewire.theme-toggle');
    }
}
