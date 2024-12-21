<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SizeGuide extends Component
{
    public $sizes;
    public $chests;
    public $lengths;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Centralized data
        $this->sizes = ['S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
        $this->chests = [36, 38, 40, 42, 44, 46];
        $this->lengths = [27, 28, 29, 30, 31, 32];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.size-guide');
    }
}