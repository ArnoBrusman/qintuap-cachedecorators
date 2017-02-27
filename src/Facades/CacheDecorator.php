<?php

namespace Qintuap\CacheDecorators\Facades;

use Illuminate\Support\Facades\Facade as Facade;
use Qintuap\CacheDecorators\CacheDecorator as Decorator;
/**
 * @author Premiums
 */
class CacheDecorator extends Facade {
    
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Decorator::class; // the IoC binding.
    }
    
}
