<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder\Elements;

use Larium\FormBuilder\Element;

class Select extends Element
{
    protected $file = 'select';

    protected $options = array();

    public function __construct(
        $name,
        $options = array(),
        $selected = null,
        $attrs = array(),
        $add_empty = true,
        $empty_label = null
    ) {
        $this->name = $name;

        $this->options = $options;

        $this->attrs = $attrs;

        $html = array();

        if (true == $add_empty) {
            $html[] = $this->option($empty_label, null, $selected);
        }

        foreach ($options as $value => $label) {

            if (is_array($label)) {
                $html[] = $this->optgroup($value, $label, $selected);
            } else {
                $html[] = $this->option($label, $value, $selected);
            }
        }

        $this->value = implode("    ", $html);
    }

    public function getOptions()
    {
        return $this->options;
    }

    protected function option($label, $value, $selected)
    {
        $value = is_bool($value) ? (int) $value : $value;

        $selected = ((string) $value == (string) $selected)
            ? 'selected'
            : null;
        $attrs = array('value' => $this->encode($value), 'selected'=>$selected);

        return '<option'.$this->attributes($attrs).'>'
            .$this->encode($label).'</option>'.PHP_EOL;
    }

    protected function optgroup($label, $options, $selected)
    {
        $html = array();

        foreach ($options as $value=>$tag){
            $html[] = $this->option($tag, $value, $selected);
        }

        return '<optgroup label="'.$this->encode($label).'">'.implode("    ",$html).'</optgroup>'.PHP_EOL;
    }
}
