<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class tinymceEditor extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public $descripcion;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.tinymce-editor');
    }
}
