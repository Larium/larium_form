<?php 

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder;

use Larium\FormBuilder\Element;
use Larium\FormBuilder\Elements\Checkbox;
use Larium\FormBuilder\Elements\Select;
use Larium\FormBuilder\Elements\Label;
use Larium\FormBuilder\Elements\Textarea;
use Larium\FormBuilder\Elements\Button;
use Larium\FormBuilder\Elements\Text;
use Larium\FormBuilder\Elements\Radio;

class ElementTest extends \PHPUnit_Framework_TestCase
{
    public function testInputRender()
    {
        $r = new Radio('poll', '');
        $this->equals(
            '<input type="radio" name="poll" value="" />',
            $r
        );

        $b = new Button('submit');
        $this->equals(
            '<button type="submit">submit</button>',
            $b
        );

        $t = new Text('username', '', ['id'=>'username']);
        $this->equals(
            '<input id="username" type="text" name="username" value="" />',
            $t
        );

        $c = new Checkbox('username', 1, ['id'=>'username']);
        $this->equals(
            '<input id="_username" type="hidden" name="username" value="0" />'.PHP_EOL.'<input id="username" checked="checked" type="checkbox" name="username" value="1" />',
            $c
        );
    }

    public function testSelectRender()
    {
        $options = array(
            'Linux', 
            'Ubuntu', 
            'Arch',
            'Software' => array(
                'Gimp',
                'Google Chrome',
            ), 
            'Debian'
        );
        $s = Element::select('systems', $options, 2);
        $this->equals(
            '<select name="systems">
    <option value=""></option>
    <option value="0">Linux</option>
    <option value="1">Ubuntu</option>
    <option value="2" selected="selected">Arch</option>
    <optgroup label="Software"><option value="0">Gimp</option>
    <option value="1">Google Chrome</option>
</optgroup>
    <option value="3">Debian</option>
</select>',
            $s
        );
    }

    public function testTextareaRender()
    {
        $t = new Textarea('text', 'Lorem Ipsum', ['id'=>'textarea']);
        $this->equals(
            '<textarea name="text" id="textarea" rows="10" cols="30">Lorem Ipsum</textarea>',
            $t
        );
    }

    public function testLabelRender()
    {
        $l = new Label('Username', 'username');
        $this->equals(
            '<label for="username">Username</label>',
            $l
        );
    }

    protected function equals($string, $element)
    {
        $this->assertEquals($string, trim($element->__toString()));
    }
}
