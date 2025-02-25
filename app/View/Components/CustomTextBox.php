<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomTextBox extends Component
{
    public $id;
    public $name;
    public $value;
    public $placeholder;
    public $class;
    
    public $label;
    /**
     * Create a new component instance.
     */
    public function __construct($name,  $class = null,  $value = null, $placeholder = null, $label = null)
    {
        $this->name = $name;
        $this->class = $class;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-text-box');
    }
}
