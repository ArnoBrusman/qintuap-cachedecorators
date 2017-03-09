<?php

namespace Qintuap\CacheDecorators;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

/**
 * Cache decorator helper
 * @author Premiums
 */
class DecoCache {
    
    var $factories = [];
    
    
    function addFactory($factory) {
        $this->factories[] = $factory;
    }
    
    function decorate($decoratable) {
        $factory = $this->getFactory($decoratable);
        if(!$factory) {
            throw new \Exception('no factory found');
        }
        return $factory->make($decoratable);
    }
    
    function getFactory($decoratable) {
        foreach ($this->factories as $factory) {
            if($factory->canDecorate($decoratable)) {
                return $factory;
            }
        }
        \Debugbar::addMessage($decoratable, 'warning');
        throw new \Exception('Cannot decorate object');
    }
            
    function canDecorate($object) {
        foreach ($this->factories as $factory) {
            if($factory->canDecorate($object)) {
                return true;
            }
        }
        return false;
    }
    
    // Get tag of an ORM model object.
    function makeModelTag(Model $object) {
        return get_class($object);
    }
    function makeRelationTag(Model $object, $relationName)
    {
        return get_class($object->$relationName()->getRelated());
    }
    
}
