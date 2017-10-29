<?php 

namespace Lex;

use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;

class RestValidator extends Validator {

    /**
     * Add an error message to the validator's collection of messages.
     *
     * @param  string  $attribute
     * @param  string  $rule
     * @param  array   $parameters
     * @return void
     */
    protected function addFailure($attribute, $rule, $parameters)
    {
        $message = $this->getMessage($attribute, $rule);

        $message = $this->makeReplacements($message, $attribute, $rule, $parameters);

        $customMessage = new MessageBag();

        $customMessage->merge(['type' => strtolower($rule)]);
        $customMessage->merge(['message' => $message]);

        $this->messages->add($attribute, $customMessage);
    }

}