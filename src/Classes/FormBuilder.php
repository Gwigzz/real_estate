<?php

require_once 'FormValidator.php';

/**
 * Class Form Builder
 */
class FormBuilder extends FormValidator
{
    /** METHOD  : "$_GET" or "$_POST"*/
    public array $method;

    /** NAME VALUE IN FORM*/
    public array $required;

    public function __construct(array $method, array $required)
    {
        $this->method = $method;
        $this->required = $required;

        foreach ($this->method as $key => $value) {
            if (in_array($key, $this->required)) {
                // echo "key exist : {$key} & {$value} ";
                return $value;
            }
        }
    }
}
