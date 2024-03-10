<?php

namespace App\View\Components;

use Illuminate\View\Component;

class image extends Component
{
    public $photo, $folder, $width, $height, $extension, $ratio, $item;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($photo,$item,$folder,$width,$height,$extension,$ratio)
    {
        $this->photo = $photo;
        $this->item = $item;
        $this->folder = $folder;
        $this->width = $width;
        $this->height = $height;
        $this->extension = $extension;
        $this->ratio = $ratio;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.image');
    }
}
