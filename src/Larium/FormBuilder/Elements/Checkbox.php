<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder\Elements;

use Larium\FormBuilder\Element;

class Checkbox extends Input
{
    protected $checked_value;

    protected $unchecked_value;

    public function __construct(
        $name, 
        $value, 
        $attrs = array(),
        $checked_value = 1, 
        $unchecked_value = 0
    ) {

        $this->checked_value = $checked_value;
        
        $this->unchecked_value = $unchecked_value;
        

        ((string) $value == (string) $checked_value)
            ? $attrs['checked'] = 'checked'
            : null;

        parent::__construct('checkbox', $name, $checked_value, $attrs);
    }

    public function getChecked()
    { 
        return $checked_value;
    }

    public function getUnchecked()
    {
        return $unchecked_value; 
    }

    public function render()
    {
        $render = parent::render();

        $hidden = Element::hidden(
            $this->name, 
            $this->unchecked_value, 
            array('id'=>'_' . $this->attrs['id'])
        )->render();

        return $hidden . $render;
    }
}
