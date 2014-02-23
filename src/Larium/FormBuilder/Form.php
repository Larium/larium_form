<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder;

use Larium\FormBuilder\Element;

/**
 * Form class allows to create html elements for forms.
 *
 * It can renders html form elements from the public accessible properties or
 * methods of a given class.
 *
 * Each html element name has a prefix of class name.
 *
 * @vendor  Larium
 * @package FormBuilder
 * @author  Andreas Kollaros <andreaskollaros@ymail.com>
 * @license MIT {@link http://opensource.org/licenses/mit-license.php}
 */
class Form
{
    protected $class;

    protected $path;

    protected $name;

    /**
     *
     * @param  mixed $class     The class to create a form for.
     * @param  string $encoding The character en coding to use for html
     *                          escaping.
     * @access public
     *
     * @return Form A new form instance.
     */
    public function __construct($class, $name=null, $encoding='UTF-8')
    {
        $this->class = $class;

        $this->name = $name;
    }

    /**
     * Sets the path to html template files.
     *
     * @var string $path
     *
     * @return void
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Gets the path of html templates.
     *
     * @access public
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Creates a label html element.
     *
     * @param mixed $name  The display tag for the label element.
     * @param mixed $for   The html attribute `for`.
     * @param array $attrs Html attributes for this element
     * @access public
     * @return Element
     */
    public function label($name, $for, $attrs = array())
    {
        $tag = $for;
        $form_name = $this->createName($for, __FUNCTION__);
        $for = $this->createId($form_name);

        $element = Element::{__FUNCTION__}($name, $for, $attrs);

        $element->setTag($tag);

        return $this->return_element($element);
    }

    public function textarea($name, $attrs = array())
    {
        $value = $this->getValue($name);

        $form_name = $this->createName($name, __FUNCTION__);

        $attrs['id'] = isset($attrs['id'])
            ? $attrs['id']
            : $this->createId($form_name);

        $element = Element::{__FUNCTION__}($form_name, $value, $attrs);
        $element->setTag($name);

        return $this->return_element($element);
    }

    public function select(
        $name,
        $options = array(),
        $attrs = array(),
        $add_empty = true
    ) {

        $selected = $this->getValue($name);

        $form_name = $this->createName($name, __FUNCTION__);

        $attrs['id'] = isset($attrs['id'])
            ? $attrs['id']
            : $this->createId($form_name);

        $element = Element::{__FUNCTION__}($form_name, $options, $selected, $attrs, $add_empty);
        $element->setTag($name);

        return $this->return_element($element);
    }

    public function checkbox(
        $name,
        $attrs = array(),
        $checked_value = 1,
        $unchecked_value = 0
    ) {

        $value = $this->getValue($name);

        $form_name = $this->createName($name, __FUNCTION__);

        $attrs['id'] = isset($attrs['id'])
            ? $attrs['id']
            : $this->createId($form_name);

        $element = Element::{__FUNCTION__}($form_name, $value, $attrs, $checked_value, $unchecked_value);
        $element->setTag($name);
        // Element::hidden($name, $unchecked_value, array('id'=>'_' . $attrs['id']))

        return $this->return_element($element);
    }

    public function radio($name, $checked = false, $attrs = array())
    {
        $value = $this->getValue($name);

        $form_name = $this->createName($name, __FUNCTION__);

        $attrs['id'] = isset($attrs['id'])
            ? $attrs['id']
            : $this->createId($form_name);

        $element = Element::{__FUNCTION__}($form_name, $value, $checked, $attrs);
        $element->setTag($name);

        return $this->return_element($element);
    }

    public function hidden($name, $attrs = array())
    {
        return $this->input('hidden', $name, $attrs);
    }

    public function text($name, $attrs = array())
    {
        return $this->input('text', $name, $attrs);
    }

    public function file($name, $attrs = array())
    {
        return $this->input('file', $name, $attrs);
    }

    public function password($name, $attrs = array())
    {
        return $this->input('password', $name, $attrs);
    }

    public function input($type = "submit", $name, $attrs = array())
    {

        $value = $type == 'password' ? '' : $this->getValue($name);

        $form_name = $this->createName($name, $type);

        $attrs['id'] = isset($attrs['id'])
            ? $attrs['id']
            : $this->createId($form_name);

        $element = Element::{$type}($form_name, $value, $attrs);
        $element->setTag($name);

        return $this->return_element($element);
    }

    public function button($tag, $type = 'submit', $attrs = array())
    {
        $element = Element::{__FUNCTION__}($tag, $type, $attrs);

        return $this->return_element($element);
    }

    /**
     * Searches the self::$class for the given $property and return its value.
     *
     * If property does not exists or is not public visible then searches for
     * getter method in format of `getProperty()`
     *
     * @var string $property.
     *
     * @return string|array
     */
    public function getValue($property)
    {
        $getter = 'get'.ucfirst($property);

        if (isset($this->class->$property)) {

            return $this->class->$property;

        } elseif (is_callable(array($this->class, $getter))) {

            return $this->class->$getter();
        }

        throw new \InvalidArgumentException(get_class($this->class) . "::{$property} does not exists.");
    }

    public function createName($property, $type)
    {
        if ($type !== 'file') {
            return $this->getFormName() . "[$property]";
        }
        return $property;
    }

    public function getFormName()
    {
        if (null !== $this->name) {
            return $this->name;
        }
        $class = get_class($this->class);
        $class = str_replace('\\','', $class);

        return strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $class));
    }

    public function createId($name)
    {
        return str_replace(array('[',']'), array('_',''), $name);
    }

    public static function create($class, \Closure $block)
    {
        $f = new static($class);
        $block($f);
    }

    protected function return_element(Element $element)
    {
        $element->setForm($this);
        $element->setPath($this->getPath());

        return $element;
    }
}