<?php

require_once 'FormConstraints.php';

/**
 * Class Form Validator
 */
class FormValidator extends FormConstraints
{
    public function __construct(FormBuilder $formBuilder)
    {
        if (isset($formBuilder->method)) {
            foreach ($formBuilder->method as $key => $data) {
                if (!$this->verify($data)) {
                    $this->errors[] = "champ <b>#{$key}</b> est requis.";
                } else {
                    $this->valide[] = "Donnée Valide #{$data}. Clée #{$key}.";
                }
            }
        }
    }

    public function isValide()
    {
        return $this->errors ? false : true;
    }

    public function isSubmit()
    {
        return ($_POST || $_GET) ?? false; 
    }
}
