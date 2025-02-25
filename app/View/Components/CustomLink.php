<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomLink extends Component
{
    public $label;
    public $url;
    public $color;

    /**
     * Create a new component instance.
     */
    public function __construct($label,$url,$color)
    {
        $this->label=$label;
        $this->url=$url;
        $this->color=$color;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-link');
    }
}