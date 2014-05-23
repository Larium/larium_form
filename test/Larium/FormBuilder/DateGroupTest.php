<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder;

class DateGroupTest extends \PHPUnit_Framework_TestCase
{
    public function testDateFormatWithCustomOptions()
    {

        $class = new \FormClass();
        $class->date = date('Y-m-d');
        FormGroup::create($class, function($f) {

            echo $f->dateTimeGroup('date', 'Date', [], [], array_combine(range(1970, 2012),range(1970, 2012)));
        });
    }
}
