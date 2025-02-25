<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomButton extends Component
{
    public $type;
    public $text;
    public $url;
    public $attributes;
    /**
     * Create a new component instance.
     */
    public function __construct($text, $type = 'button', $url = null, $attributes = [])
    {
        $this->text = $text;
        $this->type = $type;
        $this->url = $url;
        $this->attributes = $attributes;
       
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-button');
    }
}
