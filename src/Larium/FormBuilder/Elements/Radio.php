<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder\Elements;

class Radio extends Input
{
    protected $checked = false;


    public function __construct(
        $name, 
        $value, 
        $checked = false, 
        $attrs = array()
    ) {

        $this->checked = $checked;
        
        if (true == $checked) {
            $attrs['checked'] = 'checked';
        }

        parent::__construct('radio', $name, $value, $attrs);
    }

    public function isChecked()
    { 
        return $checked;
    }
}
