<?php

// Dependency
require_once 'larium_template/autoload.php';

require_once 'ClassMap.php';

$classes = array(
    'Larium\\FormBuilder\\Element' => 'Larium/FormBuilder/Element.php',
    'Larium\\FormBuilder\\Form' => 'Larium/FormBuilder/Form.php',
    'Larium\\FormBuilder\\Render' => 'Larium/FormBuilder/Render.php',
    'Larium\\FormBuilder\\FormValidation' => 'Larium/FormBuilder/FormValidation.php',
    'Larium\\FormBuilder\\FormGroup' => 'Larium/FormBuilder/FormGroup.php',
    'Larium\\FormBuilder\\Elements\\Text' => 'Larium/FormBuilder/Elements/Text.php',
    'Larium\\FormBuilder\\Elements\\File' => 'Larium/FormBuilder/Elements/File.php',
    'Larium\\FormBuilder\\Elements\\Label' => 'Larium/FormBuilder/Elements/Label.php',
    'Larium\\FormBuilder\\Elements\\Password' => 'Larium/FormBuilder/Elements/Password.php',
    'Larium\\FormBuilder\\Elements\\Hidden' => 'Larium/FormBuilder/Elements/Hidden.php',
    'Larium\\FormBuilder\\Elements\\Select' => 'Larium/FormBuilder/Elements/Select.php',
    'Larium\\FormBuilder\\Elements\\Button' => 'Larium/FormBuilder/Elements/Button.php',
    'Larium\\FormBuilder\\Elements\\Checkbox' => 'Larium/FormBuilder/Elements/Checkbox.php',
    'Larium\\FormBuilder\\Elements\\Textarea' => 'Larium/FormBuilder/Elements/Textarea.php',
    'Larium\\FormBuilder\\Elements\\Input' => 'Larium/FormBuilder/Elements/Input.php',
    'Larium\\FormBuilder\\Elements\\Radio' => 'Larium/FormBuilder/Elements/Radio.php',
);

ClassMap::load(__DIR__ . "/src/", $classes)->register();
