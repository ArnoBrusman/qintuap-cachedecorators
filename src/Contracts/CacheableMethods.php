<?php

namespace Qintuap\CacheDecorators\Contracts;

/**
 *
 * @author Premiums
 */
interface CacheableMethods {

    // make a cache key for a method
    function makeMethodCacheKey($method, $parameters);
    // make cache tags for a method
    function makeMethodCacheTags($method, $parameters);
}
