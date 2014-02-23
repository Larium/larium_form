<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder;

class Element
{
    protected $name;
    
    protected $value;

    protected $attrs = array();

    protected $encoding = 'UTF-8';

    protected $file;

    protected $path;
    
    protected $form;

    protected $tag;

    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getAttrs()
    {
        return $this->attrs;
    }

    public function getAttr($name)
    {
        if ($this->hasAttr($name)) {

            return $this->attrs[$name];
        }

        return null;
    }

    public function setAttr($key, $value)
    {
        $this->attrs[$key] = $value;
    }
    
    public function appendAttr($key, $value)
    {
        isset($this->attrs[$key]) 
            ? $this->attrs[$key] = $this->attrs[$key] . ' ' .$value
            : $this->attrs[$key] = $value;
    }
    
    public function hasAttr($key)
    {
        return array_key_exists($key, $this->attrs);
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setForm($form)
    {
        $this->form = $form;
    }

    public function getForm()
    {
        return $this->form;
    }

    protected function button($name, $type='submit', $attrs = array())
    {
        $attrs['type'] = $type;

        return $this->renderElement('button', $name, null, $attrs);
    }

    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
    }

    public function getEncoding()
    {
        return $this->encoding;
    }

    public function render()
    {
        $render = new Render($this->getPath());

        return $render->renderElement($this, $this->name, $this->value, $this->attrs);
    }

    public function attributes($array)
    {
        if (empty($array)) return null;

        $o = "";
        foreach ($array as $k => $v) {
             if ( null !== $v )
                $o .= ' ' . $k . '="' . $this->encode($v) . '"';
        }
        return $o;
    }

    public function encode($value)
    {
        return htmlentities($value, ENT_QUOTES, $this->getEncoding(), false);
    }

    public function decode($value)
    {
        return html_entity_decode($value, ENT_QUOTES, $this->getEncoding());
    }

    public function specialchars($value)
    {

        return htmlspecialchars($value, ENT_QUOTES, $this->getEncoding(), false);
    }

    public function __toString()
    {
        return $this->render();
    }

    public static function create()
    {
        $args = func_get_args();
        
        $class = 'Larium\\FormBuilder\\Elements\\' . ucfirst($args[0]);
        unset($args[0]);
        $reflect = new \ReflectionClass($class);

        return $reflect->newInstanceArgs($args);
    }

    public static function __callStatic($name, $args)
    {
        array_unshift($args, $name);
        
        $reflect = new \ReflectionClass(__CLASS__);

        $method = $reflect->getMethod('create');
        
        return $method->invokeArgs(null, $args);
    }
}
