<?php 

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\FormBuilder;

use Larium\FormBuilder\Form;

class FormBuilderTest extends \PHPUnit_Framework_TestCase
{

    public function testCreateFormFromClassWithClosure()
    {
        $class = new \FormClass();
        $class->username = null;
        $class->password = "eDde=-2edq";
        $class->setFirstname('Andreas');
        $class->setLastname('Kollaros');
        $class->country = "2";
        
        FormGroup::create($class, function($f) {
            echo $f->label('Username', 'username');

            echo $f->text('username', ['class'=>'test']);
            
            echo $f->text('lastname', ['class'=>'test']);
            
            echo $f->password('password');

            $countries = array(
                'Greece',
                'France',
                'Belgium',
                'Holland'
            );

            echo $f->select('country', $countries);

            echo $f->textGroup('firstname', 'Firstname', ['class'=>'span4']);
            
            echo $f->passwordGroup('password', 'Password');
        });

        $output = <<<EOT
<label for="form_class_username">Username</label>
<input class="test" id="form_class_username" type="text" name="form_class[username]" value="" />
<input class="test" id="form_class_lastname" type="text" name="form_class[lastname]" value="Kollaros" />
<input id="form_class_password" type="password" name="form_class[password]" value="" />
<select name="form_class[country]" id="form_class_country">
    <option value=""></option>
    <option value="0">Greece</option>
    <option value="1">France</option>
    <option value="2" selected="selected">Belgium</option>
    <option value="3">Holland</option>
</select>
<div class="control-group">
    <label for="form_class_firstname" class="control-label">Firstname</label>
    <div class="controls">
        <input class="span4" id="form_class_firstname" type="text" name="form_class[firstname]" value="Andreas" />
    </div>
</div>
<div class="control-group">
    <label for="form_class_password" class="control-label">Password</label>
    <div class="controls">
        <input id="form_class_password" type="password" name="form_class[password]" value="" />
    </div>
</div>
EOT;
        $this->expectOutputString($output.PHP_EOL);
    }
}
