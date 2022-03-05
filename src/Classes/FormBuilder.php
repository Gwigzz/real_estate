<?php

class FormBuilder
{

    public array $value;

    public function __construct(array $value)
    {
        $this->value[] = $value;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }
}
