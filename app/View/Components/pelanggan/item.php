<?php

namespace App\View\Components\pelanggan;

use Illuminate\View\Component;

class item extends Component
{
    public $outlineInfo;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($outlineInfo)
    {
        $this->outlineInfo = $outlineInfo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.pelanggan.item');
    }
}
