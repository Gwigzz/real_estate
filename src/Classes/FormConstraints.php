<?php

/**
 * Class Form Constraints
 */
class FormConstraints
{

    public array $errors = [];
    public array $valide = [];

/*     public function __construct()
    {
        return $this->errors;
    } */

    /** Verify if isset "value" and not empty */
    public function verify($value)
    {
        return (!isset($value) && empty($value) && $value !== " " ? $value = null : htmlspecialchars($value));
    }

    /** Length "min" & "max" */
    public static function controllLength($value, $min, $max)
    {
        if (strlen($value) < $min || strlen($value) > $max) {
            $value = null;
        }
        return htmlspecialchars($value);
    }

    /** Only "String" */
    public static function controllString($value)
    {
        return !is_string($value) ? $value = null : htmlspecialchars($value);
    }

    /** Only "Integer" */
    public static function controllInt($value)
    {
        return !is_int($value) ? $value = null : htmlspecialchars($value);
    }
}
