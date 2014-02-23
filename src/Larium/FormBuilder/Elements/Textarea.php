<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder\Elements;

use Larium\FormBuilder\Element;

class Textarea extends Element
{
    protected $file = 'textarea';


    public function __construct($name, $value = null, $attrs = array())
    {
        $this->name = $name;

        $this->value = $value;

        if (!isset($attrs['rows'])) $attrs['rows'] = 10;
        if (!isset($attrs['cols'])) $attrs['cols'] = 30;

        $this->attrs = $attrs;
    }
}
