<?php

namespace Qintuap\CacheDecorators\Facades;

use Illuminate\Support\Facades\Facade as Facade;
use Qintuap\CacheDecorators\DecoCache as Decorator;
/**
 * @author Premiums
 */
class DecoCache extends Facade {
    
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
