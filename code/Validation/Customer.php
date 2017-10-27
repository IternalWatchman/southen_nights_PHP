<?php

namespace Lex\Validation;

use Lex\Watchman;
use Illuminate\Contracts\Validation\Rule;

class Customer extends Watchman implements Rule {
    public function passes($attribute, $value) {
        return $this->findCustomer($value);
    }
    public function message() {
        return 'Customer not found.';
    }
}
