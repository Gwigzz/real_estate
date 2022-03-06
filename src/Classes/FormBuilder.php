<?php

require_once 'FormValidator.php';

/**
 * Class Form Builder
 */
class FormBuilder extends FormValidator
{
    /** Method  : "$_GET" or "$_POST"*/
    public array $method;

    /** Value "name" in "form" */
    public array $required;

    public function __construct(array $method, array $required)
    {
        $this->method = $method;
        $this->required = $required;

        foreach ($this->method as $key => $value) {
            if (in_array($key, $this->required)) {
                return $value;
            }
        }
    }
}
