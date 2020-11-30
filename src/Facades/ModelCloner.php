<?php

namespace EbereOnyechere\ModelCloner\Facades;

use Illuminate\Support\Facades\Facade;

class ModelCloner extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'EbereOnyechere\ModelCloner\ModelCloner';
    }
}