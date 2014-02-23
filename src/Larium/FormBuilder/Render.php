<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder;

use Larium\View\ViewInterface;
use Larium\View\View;

class Render
{
    protected $engine;

    protected $path;

    protected static $template;

    public function __construct($path = null)
    {
        $this->path = $path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function renderElement($element, $name, $value = null, $attrs = array())
    {
        $this->getEngine()->assign('name', $element->getName());

        $this->getEngine()->assign('value', $element->getValue());

        if (null !== $element->getForm()) {
            $this->getEngine()->assign('form', $element->getForm());
        }

        $this->getEngine()->assign('element', $element);

        $this->getEngine()->assign('render', $this);

        $this->getEngine()->assign('attributes', $element->getAttrs());

        if (!file_exists($this->getPath() . 'form' . $this->getEngine()->getExtension())) {
            $this->getEngine()->setPath(dirname(__FILE__) . '/views/');
        }

        $this->getEngine()->render('form');

        ob_start();
        $this->getEngine()->block($element->getFile());
        $template = ob_get_clean();

        return $template;

    }

    public function setEngine(ViewInterface $engine)
    {
        $this->engine = $engine;
    }

    public function getEngine()
    {
        $path = $this->getPath() ?: dirname(__FILE__) . '/views/';
        $this->engine = $this->engine ?: new View($path);
        return $this->engine;
    }
}
