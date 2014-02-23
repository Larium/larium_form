<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder\Elements;

use Larium\FormBuilder\Element;

class Label extends Element
{
    protected $file = 'label';

    public function __construct($tag, $for = null, $attrs = array())
    {
        $attrs['for'] = $for;
        
        $this->attrs = $attrs;

        $this->name = $tag;
    }

}
