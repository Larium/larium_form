<?php 

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder;

use Larium\FormBuilder\Element;
use Larium\Validations\ValidatableInterface;

/**
 * FormValidation class allows to display errors when the form class implements 
 * the ValidatableInterface.
 * 
 * @package FormBuilder
 * @author  Andreas Kollaros <andreaskollaros@ymail.com> 
 * @license MIT {@link http://opensource.org/licenses/mit-license.php}
 */
class FormValidation extends FormGroup
{

    public function hasErrors()
    {
        return $this->class->getErrors()->count() != 0;
    }

    public function getErrors()
    {
        return $this->class->getErrors();
    }

    public function getError(Element $element)
    {
        $errors = $this->getErrors();
        return $errors[$element->getTag()];
    }

    public function elementHasErrors(Element $element)
    {
        $errors = $this->getErrors();
        
        if ($errors instanceof \ArrayIterator) {
            
            return $errors->offsetExists($element->getTag());
        } elseif (is_array($errors)) {
            
            return array_key_exists($element->getTag(), $errors);
        }
    }

    protected function return_element(Element $element)
    {
        $element = parent::return_element($element);

        if ($this->elementHasErrors($element)) {
            $element->appendAttr('class', 'error');
        }

        return $element; 
    }
}
