<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class Datatable extends Component
{
    public $headers;
    public $objects;
    public $objects_headers;
    public $edit;
    public $delete;
    public $show;
    public $name;
    public $permission;

    /**
     * Create a new component instance.
     *
     * @param array $headers
     * @param array $objects
     * @param array $objects_headers
     * @param bool $edit
     * @param bool $show
     * @param bool $delete
     * @param string $name
     * @param string $permission
     */
    public function __construct($headers = [], $objects = [], $objects_headers = [], $edit = false, $show = false, $delete = false, $name = '', $permission = '')
    {
        $this->headers = $headers;
        $this->objects = $objects;
        $this->objects_headers = $objects_headers;
        $this->edit = $edit;
        $this->delete = $delete;
        $this->show = $show;
        $this->name = $name;
        $this->permission = $permission;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table.datatable');
    }
}
