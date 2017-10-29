<?php

namespace Lex\Providers;

use Illuminate\Support\ServiceProvider;
use Lex\RestValidator;

class RestServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        \Validator::resolver(function($translator, $data, $rules, $messages)
        {
            return new RestValidator($translator, $data, $rules, $messages);
        });
    }

}
