<?php

namespace App\View\Components\pelanggan;

use Illuminate\View\Component;
use App\Repositories\ReciptService;
use App\Repositories\TransaksiRepository;

class badge extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.pelanggan.badge');
    }
}
