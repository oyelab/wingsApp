<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class breadcrub extends Component
{
    public $title;
    public $pagetitle;
    public $section;
    public $collection;
    public $category;
    public $subcategory;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $title = null, 
        $pagetitle = null, 
        $section = null, 
        $collection = null, 
        $category = null, 
        $subcategory = null
    ) {
        $this->title = $title;
        $this->pagetitle = $pagetitle;
        $this->section = $section;
        $this->collection = $collection;
        $this->category = $category;
        $this->subcategory = $subcategory;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcrub');
    }
}
