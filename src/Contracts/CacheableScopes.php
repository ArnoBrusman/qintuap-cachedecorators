<?php

namespace Qintuap\CacheDecorators\Contracts;

/**
 * The methods in this object are cachable.
 *
 * @author Premiums
 */
interface CacheableScopes {

    // make a cache key for a method
    function makeScopeCacheKey($method, $parameters);
    // make cache tags for a method
    function makeScopeCacheTags($method, $parameters);
    // use cache for the method
    function useScopeCache($method,$parameters) ;
    
}
