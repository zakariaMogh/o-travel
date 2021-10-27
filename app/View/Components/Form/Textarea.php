<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $name;
    public $value;
    public $is_required;
    public $rows;
    public $cols;
    public $is_disabled;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param string $value
     * @param bool $isRequired
     * @param int $rows
     * @param int $cols
     * @param bool $isDisabled
     */
    public function __construct($name, $value = '', $isRequired = false, $rows = 10, $cols = 30, $isDisabled = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->is_required = $isRequired;
        $this->cols = $cols;
        $this->rows = $rows;
        $this->is_disabled = $isDisabled;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.textarea');
    }
}
