<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder\Elements;

class Text extends Input
{
    public function __construct($name, $value, $attrs = array())
    {
        parent::__construct('text', $name, $value, $attrs);
    }
}
