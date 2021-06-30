<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Datatable extends Component
{
    public $id;
    public $route;
    public $columns;
    public $order;
    public $crud;
    public $filters;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id,
        $route,
        $order = [1, 'asc'],
        $columns,
        $crud = NULL,
        $filters = NULL
    ) {
        $this->id = $id;
        $this->route = $route;
        $this->columns = $columns;
        $this->order = $order;
        $this->crud = $crud;
        $this->filters = $filters;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.datatable.index');
    }
}
