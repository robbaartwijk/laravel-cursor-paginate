<?php

namespace Bitsnbolts\CursorPaginate;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class CursorPaginator implements Arrayable, Jsonable
{
    protected $items;
    protected $nextCursor;
    protected $currentCursor;
    protected $params = [];

    public function __construct($items, $nextCursor = null)
    {
        $this->items = $items;
        $this->nextCursor = $nextCursor;
        $this->currentCursor = self::currentCursor();
    }

    public static function currentCursor()
    {
        return json_decode(base64_decode(request('cursor')));
    }

    public function appends($params)
    {
        $this->params = $params;

        return $this;
    }

    public function items()
    {
        return $this->items;
    }

    public function count()
    {
        return $this->items->count();
    }

    public function total()
    {
        // @todo
        return 'todo';
    }

    public function currentCursorUrl()
    {
        return $this->currentCursor ? url()->current().'?'.http_build_query(array_merge([
                'cursor' => base64_encode(json_encode($this->currentCursor)),
            ], $this->params)) : null;
    }

    public function nextCursorUrl()
    {
        return $this->nextCursor ? url()->current().'?'.http_build_query(array_merge([
            'cursor' => base64_encode(json_encode($this->nextCursor)),
        ], $this->params)) : null;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'data' => $this->items->toArray(),
            'self' => $this->currentCursorUrl(),
            'next' => $this->nextCursorUrl(),
            'count' => $this->count(),
            'total' => $this->total(),
        ];
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray());
    }
}
