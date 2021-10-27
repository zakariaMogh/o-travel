<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $label;
    public $value;
    public $type;
    public $is_required;
    public $is_disabled;

    /**
     * Create a new component instance.
     * @param $name
     * @param string $label
     * @param string $value
     * @param string $type
     * @param bool $isRequired
     * @param bool $isDisabled
     */
    public function __construct($name,$label = '', $value = '', $type = 'text', $isRequired = false, $isDisabled = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->type = $type;
        $this->is_required = $isRequired;
        $this->is_disabled = $isDisabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
