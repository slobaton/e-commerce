<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $id;
    public $backdrop;
    public $keyboard;
    public $focus;
    public $title;
    public $size;
    public $headerBgColor;
    public $btnCloseName;
    public $btnCloseColor;
    public $configFile;
    public $configVarName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id,
        $backdrop = 'true', //boolean o 'static'
        $keyboard = 'true', //boolean
        $focus = 'true', //boolean
        $title,
        $size, //sm, lg, xl
        $headerBgColor,
        $btnCloseName = NULL,
        $btnCloseColor,
        $configFile = NULL,
        $configVarName = NULL
    ) {
        $this->id = $id;
        $this->backdrop = $backdrop;
        $this->keyboard = $keyboard;
        $this->focus = $focus;
        $this->title = $title;
        $this->size = $size;
        $this->headerBgColor = $headerBgColor;
        $this->btnCloseName = $btnCloseName;
        $this->btnCloseColor = $btnCloseColor;
        $this->configFile = $configFile;
        $this->configVarName = $configVarName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.modal.index');
    }
}
