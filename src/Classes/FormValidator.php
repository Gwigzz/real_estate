<?php

require_once 'FormConstraints.php';

/**
 * Class Form Validator
 */
class FormValidator extends FormConstraints
{
    public function __construct(FormBuilder $formBuilder)
    {
        foreach ($formBuilder->method as $key => $data) {
            if (!$this->verify($data)) {
                // echo "Donnée # {$data}. Clée #{$key} <br>";
                echo "Le champ #{$key} est requis.<br>";
            } else {
                echo "Donnée Valide #{$data}. Clée #{$key} <br>";
            }
        }
    }
}
