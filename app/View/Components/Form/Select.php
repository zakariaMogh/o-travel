<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $value;
    public $type;
    public $is_required;
    public $options;
    public $default;
    public $is_disabled;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param string $value
     * @param string $type
     * @param bool $isRequired
     * @param array $options
     * @param null $default
     * @param bool $isDisabled
     */
    public function __construct($name, $value = '', $type = 'text', $isRequired = false, $options = [], $default = null, $isDisabled = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->is_required = $isRequired;
        $this->options = $options;
        $this->default = $default;
        $this->is_disabled = $isDisabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select');
    }
}
