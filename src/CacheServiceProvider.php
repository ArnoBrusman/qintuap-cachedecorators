<?php

namespace Qintuap\CacheDecorators;

use Illuminate\Support\ServiceProvider;

/**
 * @author Premiums
 */
class CacheServiceProvider extends ServiceProvider {
    
    function register() {
        
        $this->app->singleton(DecoCache::class, function($app) {
            $factory = $app->make(Factory::class);
            $decorator = new DecoCache();
            $decorator->addFactory($factory);
            return $decorator;
        });
        $this->app->singleton(Factory::class, function() {
            $decorators = config('qintuap.cache_decorators');
            $decorator = new Factory($decorators);
            return $decorator;
        });
    }
    
}
