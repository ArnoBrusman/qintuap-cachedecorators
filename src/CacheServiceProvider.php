<?php

namespace Qintuap\CacheDecorators;

use Illuminate\Support\ServiceProvider;

/**
 * @author Premiums
 */
class CacheServiceProvider extends ServiceProvider {
    
    function boot() {
        
        $this->app->singleton(CacheDecorator::class, function() {
            $decorators = config('qintuap.decorators');
            $decorator = new CacheDecorator($decorators);
            return $decorator;
        });
    }
    
}
