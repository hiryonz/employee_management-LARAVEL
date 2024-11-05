<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class TableLayout extends Component
{
    public $columns;
    public $data;

    /**
     * Create a new component instance.
     */
    public function __construct(array $columns, array $data )
    {
        $this->columns = $columns;
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tables-layout');
    }
}
