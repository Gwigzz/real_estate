<?php

/**
 * Class Form Constraints
 */
class FormConstraints
{

    public mixed $constraints;

    public function addConstraint(array $constraint)
    {
    }

    static public function controllLength($value, $min, $max)
    {
        if (strlen($value) < $min || strlen($value) > $max) {
            $value = null;
        }
        return $value;
    }

    static public function controllString($value)
    {
        if (!is_string($value)) {
            $value = null;
        }
        return $value;
    }

    static public function controllInt($value)
    {
        if (!is_int($value)) {
            $value = null;
        }
        return $value;
    }
}
