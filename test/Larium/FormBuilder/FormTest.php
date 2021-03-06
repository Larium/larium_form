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

            echo $f->select('country', $countries, [], true, 'Choose');

            echo $f->textGroup('firstname', 'Firstname', ['class'=>'span4']);

            echo $f->passwordGroup('password', 'Password');
        });

        $output = <<<EOT
<label for="form_class_username">Username</label>
<input class="test" id="form_class_username" type="text" name="form_class[username]" value="" />
<input class="test" id="form_class_lastname" type="text" name="form_class[lastname]" value="Kollaros" />
<input id="form_class_password" type="password" name="form_class[password]" value="" />
<select name="form_class[country]" id="form_class_country">
    <option value="">Choose</option>
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

    public function testCreateFormInstance()
    {
        $topic = new \Topic();

        $topic->title = 'My topic';

        $form = new Form($topic);

        echo $form->label('Title', 'title');
        echo $form->text('title');

        echo $form->label('Content', 'content');
        echo $form->textarea('content');

        echo $form->label('Approved', 'approved');
        echo $form->checkbox('approved');

        echo $form->label('Category', 'category');

        $options = ['Category 1', 'Category 2', 'Category 3'];
        echo $form->select('category', $options);

        $output = <<<EOT
<label for="topic_title">Title</label>
<input id="topic_title" type="text" name="topic[title]" value="My topic" />
<label for="topic_content">Content</label>
<textarea name="topic[content]" id="topic_content" rows="10" cols="30"></textarea>
<label for="topic_approved">Approved</label>
<input id="_topic_approved" type="hidden" name="topic[approved]" value="0" />
<input id="topic_approved" type="checkbox" name="topic[approved]" value="1" />
<label for="topic_category">Category</label>
<select name="topic[category]" id="topic_category">
    <option value="" selected="selected"></option>
    <option value="0">Category 1</option>
    <option value="1">Category 2</option>
    <option value="2">Category 3</option>
</select>
EOT;

        $this->expectOutputString($output.PHP_EOL);
    }
}
