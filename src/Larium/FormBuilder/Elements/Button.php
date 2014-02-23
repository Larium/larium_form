<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder\Elements;

use Larium\FormBuilder\Element;

/**
 * Button 
 * 
 * @uses    Element
 * @package Larium\FormBuilder 
 * @author  Andreas Kollaros <andreaskollaros@ymail.com> 
 * @license MIT {@link http://opensource.org/licenses/mit-license.php}
 */
class Button extends Element
{

    /**
     * @var string
     * @access protected
     */
    protected $type = 'submit';
    
    /**
     * @var string
     * @access protected
     */
    protected $file = 'button';

    public function __construct($name, $type='submit', $attrs = array())
    {
        $this->name = $name;

        $this->type = $type;

        $attrs['type'] = $type;
        $this->attrs = $attrs;

    }

    public function getType()
    {
        return $this->type;
    }
}
