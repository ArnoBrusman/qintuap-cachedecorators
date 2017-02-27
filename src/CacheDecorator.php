<?php

namespace Qintuap\CacheDecorators;

/**
 * @author Premiums
 */
class CacheDecorator {
    
    var $decorators;
    
    public function __construct($decorators)
    {
        $this->decorators = $decorators;
    }
    
    function canDecorate($object) {
        foreach ($this->decorators as $decoratable => $decorator) {
            if($object instanceof $decoratable) {
                return true;
            }
        }
        return false;
    }
    
    function decorate($decoratable) {
        return new $this->decorators[get_class($decoratable)](app('cache.store'), $decoratable);
    }
    
}
