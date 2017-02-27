<?php

namespace Qintuap\CacheDecorators\Contracts;

/**
 * Description of CacheDecorator
 *
 * @author Premiums
 */
interface CacheDecorator extends CacheableMethods
{

    function cached($bool = true);
    
    /** generic methods **/
   

    function all($columns = ['*']);
    
    function find($id);

}
