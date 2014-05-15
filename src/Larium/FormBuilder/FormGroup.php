<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder;

/**
 * FormGroup class allows to render multiple form elements at once, like labels
 * with inputs.
 *
 * @uses    Form
 * @vendor  Larium
 * @package FormBuilder
 * @author  Andreas Kollaros <andreaskollaros@ymail.com>
 * @license MIT {@link http://opensource.org/licenses/mit-license.php}
 */
class FormGroup extends Form
{

    /**
     * Renders an html template including a label element and an input text
     * element.
     *
     * @param  string $name       The name of text input element.
     * @param  string $label      The display tag of label input element.
     * @param  array $attrs       An array of html attributes for input
     *                            element.
     * @param  array $label_attrs An array of html attributes for label
     *                            element.
     * @access public
     *
     * @return string The rendered template.
     */
    public function textGroup(
        $name,
        $label = null,
        $attrs = array(),
        $label_attrs = array()
    ) {

        return $this->inputGroup('text', $name, $label, $attrs, $label_attrs);
    }

    /**
     * Renders an html template including a label element and an input password
     * element.
     *
     * @param  string $name       The name of password input element.
     * @param  string $label      The display tag of label input element.
     * @param  array $attrs       An array of html attributes for input
     *                            element.
     * @param  array $label_attrs An array of html attributes for label
     *                            element.
     * @access public
     *
     * @return string The rendered template.
     */
    public function passwordGroup(
        $name,
        $label = null,
        $attrs = array(),
        $label_attrs = array()
    ) {
        return $this->inputGroup('password', $name, $label, $attrs, $label_attrs);
    }

    /**
     * Renders an html template including a label element and an input file
     * element.
     *
     * @param  string $name       The name of file input element.
     * @param  string $label      The display tag of label input element.
     * @param  array $attrs       An array of html attributes for input
     *                            element.
     * @param  array $label_attrs An array of html attributes for label
     *                            element.
     * @access public
     *
     * @return string The rendered template.
     */
    public function fileGroup(
        $name,
        $label = null,
        $attrs = array(),
        $label_attrs = array()
    ) {
        return $this->inputGroup('file', $name, $label, $attrs, $label_attrs);
    }

    /**
     * Renders an html template including a label element and an input element.
     *
     * @param  string $name       The name of input element.
     * @param  string $label      The display tag of label input element.
     * @param  array $attrs       An array of html attributes for input
     *                            element.
     * @param  array $label_attrs An array of html attributes for label
     *                            element.
     * @access public
     *
     * @return string The rendered template.
     */
    public function inputGroup(
        $type,
        $name,
        $label = null,
        $attrs = array(),
        $label_attrs = array()
    ) {

        $assigns = array(
            'input' => $this->$type($name, $attrs),
            'label' => $this->label($label, $name, $label_attrs)
        );

        return $this->return_group('input_group', $assigns);
    }

    public function checkboxGroup(
        $name,
        $label = null,
        $attrs = array(),
        $label_attrs = array(),
        $checked_value = 1,
        $unchecked_value = 0
    ) {
        $assigns = array(
            'checkbox' => $this->checkbox($name, $attrs),
            'label' => $this->label($label, $name, $label_attrs)
        );

        return $this->return_group('checkbox_group', $assigns);
    }

    public function textareaGroup(
        $name,
        $label=null,
        $attrs=array(),
        $label_attrs=array()
    ) {

        $type = 'textarea';

        $assigns = array(
            'textarea' => $this->$type($name, $attrs),
            'label' => $this->label($label, $name, $label_attrs)
        );

        return $this->return_group('textarea_group', $assigns);
    }

    public function dateTimeGroup(
        $name,
        $label=null,
        array $attrs=array(),
        array $label_attrs=array(),
        array $year_option=array(),
        array $month_option=array(),
        array $day_option=array(),
        array $hour_option=array(),
        array $minute_option=array()
    ) {
        $datetime = $this->getValue($name)
            ? new \DateTime($this->getValue($name))
            : new \DateTime();

        $assigns = array(
            'year' => $datetime->format('Y'),
            'month' => $datetime->format('m'),
            'day' => $datetime->format('d'),
            'hour' => $datetime->format('H'),
            'minute' => $datetime->format('i'),
            'seconds' => $datetime->format('s'),
            'label' => $this->label($label, $name, $label_attrs),
            'year_options' => $year_option,
            'name' => $name,
            'attrs' => $attrs
        );

        return $this->return_group('datetime_group', $assigns);
    }


    public function dateGroup(
        $name,
        $label=null,
        array $attrs=array(),
        array $label_attrs=array(),
        array $year_option=array(),
        array $month_option=array(),
        array $day_option=array()
    ) {
        $datetime = $this->getValue($name)
            ? new \DateTime($this->getValue($name))
            : new \DateTime();

        $assigns = array(
            'year' => $datetime->format('Y'),
            'month' => $datetime->format('m'),
            'day' => $datetime->format('d'),
            'label' => $this->label($label, $name, $label_attrs),
            'year_options' => $year_option,
            'name' => $name,
            'attrs' => $attrs
        );

        return $this->return_group('date_group', $assigns);
    }

    public function selectGroup(
        $name,
        $label=null,
        $options=array(),
        $attrs=array(),
        $label_attrs=array(),
        $add_empty = true,
        $empty_label = null
    ) {

        $assigns = array(
            'select' => $this->select($name, $options, $attrs, $add_empty, $empty_label),
            'label' => $this->label($label, $name, $label_attrs)
        );

        return $this->return_group('select_group', $assigns);
    }

    protected function return_group($file, $assigns = array())
    {
        $render = new Render($this->getPath());

        if (!file_exists($this->getPath() . 'form' . $render->getEngine()->getExtension())) {
            $render->getEngine()->setPath(dirname(__FILE__) . '/views/');
        }
        $render->getEngine()->assign('form', $this);

        $render->getEngine()->render('form', $assigns);

        ob_start();
        $render->getEngine()->block($file);
        $template = ob_get_clean();

        return $template;
    }
}
