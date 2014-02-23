<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder\Elements;

class Hidden extends Input
{
    public function __construct($name, $value, $attrs = array())
    {
        parent::__construct('hidden', $name, $value, $attrs);
    }
}
