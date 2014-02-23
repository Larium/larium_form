<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder\Elements;

class File extends Input
{
    public function __construct($name, $value, $attrs = array())
    {
        $value = $value['name'];
        parent::__construct('file', $name, $value, $attrs);
    }
}
