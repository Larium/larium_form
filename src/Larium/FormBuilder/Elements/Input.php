<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder\Elements;

use Larium\FormBuilder\Element;

class Input extends Element
{
    protected $type;

    protected $file = 'input';

    public function __construct($type='submit', $name, $value, $attrs = array())
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $attrs['type'] = $type;
        $this->attrs = $attrs;
    }

    public function getType()
    {
        return $this->type;
    }
}
