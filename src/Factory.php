<?php

namespace Qintuap\CacheDecorators;

/**
 * @author Premiums
 */
class Factory {
    
    var $namespaces = [];
    /**
     * Set to true if there is an expectation that a class named 'SimpleCache' exists in the namespace.
     * That class will be used if no other cache options available.
     * @var type 
     */
    var $use_simple = false;
    var $simple_cache = 'Simple';
    
    public function __construct($namespaces = [])
    {
        $this->namespaces = $namespaces;
    }
    
    static function addDecorator($namespacesNamespace, $decoratable) {
        if(is_array($decoratable)) {
            foreach ($decoratable as $v) {
                self::addDecorator($namespacesNamespace, $v);
            }
        } else {
            $this->namespaces[$decoratable] = $namespacesNamespace;
        }
    }
    
    function canDecorate($object) {
        foreach ($this->namespaces as $decoratable => $decorator) {
            if($object instanceof $decoratable) {
                return true;
            }
        }
        return false;
    }
    
    function make($decoratable) {
        $decoratorClass = $this->getDecorator($decoratable);
        if($decoratorClass) {
            $decorator = new $decoratorClass(app('cache.store'), $decoratable);
        } elseif (config('app.env') !== 'production') {
            $name = class_basename($decoratable);
            \Debugbar::addMessage('note: cache decorator not defined for ' . $name, 'warning');
            $decorator = $decoratable;
        }
        return $decorator;
    }
    
    protected function getDecorator($object) {
        foreach ($this->namespaces as $decoratable => $namespace) {
            if($object instanceof $decoratable) {
                return $this->getConcreteClass($namespace,$object);
            }
        }
    }
    
    protected function getConcreteClass($namespace, $object) {
        
        if(is_array($namespace)) {
            $concrete = $this->getConcreteClassArray($namespace, $object);
        } else {
            $concrete = $this->_getConcreteClass($namespace, $object);
            if(!$concrete && $this->use_simple) {
                $concrete = $this->_getConcreteClass($namespace, $this->simple_cache);
            }
        }
        return $concrete;
    }
    
    protected function getConcreteClassArray(array $namespace, $object) {
        foreach ($namespace as $v) {
            $class = $this->getConcreteClass($v,$object);
            if($class) {
                return $class;
            }
        }
        // still here?
        foreach ($namespace as $v) {
            $class = $this->_getConcreteClass($v,$object);
            if($class) {
                return $class;
            }
        }
    }
    protected function _getConcreteClass($namespace, $object, $name = null) {
        if(is_null($name)) {
            $name = class_basename($object);
        }
        $class = $namespace . '\\' . $name . 'Cache';
        if(class_exists($class)) {
            return $class;
        } else {
            return false;
        }
    }
    
}
