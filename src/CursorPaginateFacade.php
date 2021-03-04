<?php

namespace Bitsnbolts\CursorPaginate;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bitsnbolts\CursorPaginate\CursorPaginate
 */
class CursorPaginateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-cursor-paginate';
    }
}
