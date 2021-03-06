<?php

namespace Qintuap\CacheDecorators\Contracts;

/**
 * Decorator to adds caching functionality to object methods.
 *
 * @author Premiums
 */
interface CacheDecorator
{

    function cached($bool = true);
    
}
