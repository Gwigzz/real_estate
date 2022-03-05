<?php

/**
 * Class Form Constraints
 */
class FormConstraints
{
    /** Verify if isset "value" and not empty */
    public function verify($value)
    {
        return (!isset($value) && empty($value) && $value !== " " ? $value = null : htmlspecialchars($value));
    }

    public static function controllLength($value, $min, $max)
    {
        if (strlen($value) < $min || strlen($value) > $max) {
            $value = null;
        }
        return htmlspecialchars($value);
    }

    public static function controllString($value)
    {
        return !is_string($value) ? $value = null : htmlspecialchars($value);
    }

    public static function controllInt($value)
    {
        return !is_int($value) ? $value = null : htmlspecialchars($value);
    }
}
