<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public $name;
    public $value;
    public $is_required;
    public $checked;


    /**
     * Create a new component instance.
     *
     * @param $name
     * @param string $value
     * @param bool $is_required
     * @param bool $is_checked
     */
    public function __construct($name, $value = '', $is_required = false, $checked = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->checked = $checked;
        $this->is_required = $is_required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.checkbox');
    }
}
