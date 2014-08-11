<?php namespace Validators;

use Config;

class Backend extends Validator
{
    public function __construct($data = null, $level = null)
    {
        parent::__construct($data, $level);

        static::$rules = Config::get('validator.backend');
    }
}
