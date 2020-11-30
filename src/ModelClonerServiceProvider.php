<?php

namespace EbereOnyechere\ModelCloner;

use Illuminate\Support\ServiceProvider;
use EbereOnyechere\ModelCloner\Facades\ModelCloner as ModelClonerFacade;

class ModelClonerServiceProvider extends ServiceProvider {
    public function boot() {
        
    }

    public function register() {
        $this->app->bind('ModelCloner', function() {
            return new ModelClonerFacade();
        });
    }
}