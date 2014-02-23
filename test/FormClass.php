<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

class FormClass
{
    public static $columns;

    public $username;

    public $password;

    protected $firstname;
    
    protected $lastname;

    public $country;

    public $boolean = 1;

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setFirstname($name)
    {
        $this->firstname=$name;
    }

    public function setLastname($name)
    {
       $this->lastname=$name;
    }
}
