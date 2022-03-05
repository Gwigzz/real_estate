<?php

// require_once 'FormConstraints.php';

/**
 * Class Form Validator.
 * Form Constraints is required 
 * 
 */
class FormValidator
{

    public array $method;

    public function __construct()
    {

    }


    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }
}
