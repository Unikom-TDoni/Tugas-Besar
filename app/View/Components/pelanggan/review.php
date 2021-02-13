<?php

namespace App\View\Components\pelanggan;

use Illuminate\View\Component;

class review extends Component
{
    public $reviewInfo;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($reviewInfo)
    {
        $this->reviewInfo = $reviewInfo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.pelanggan.review');
    }
}
