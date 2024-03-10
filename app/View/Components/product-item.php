<?php

namespace App\View\Components;

use Illuminate\View\Component;

class product-item extends Component
{
    public $item;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item,$key)
    {
        $this->item = $item;
        $this->key = $key;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-item');
    }
}
