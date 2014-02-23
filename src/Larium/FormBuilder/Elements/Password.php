<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder\Elements;

class Password extends Input
{
    public function __construct($name, $value, $attrs = array())
    {
        parent::__construct('password', $name, $value, $attrs);
    }
}
