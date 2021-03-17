<?php

namespace Bitsnbolts\CursorPaginate;

use Illuminate\Database\Eloquent\Builder;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder

 */
class CursorPaginateServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-cursor-paginate')
            ->hasConfigFile();
    }

    /**
     * @return void
     */
    public function boot()
    {
        $this->registerMacro();
    }

    /**
     * @psalm-suppress UndefinedMethod
     */
    protected function registerMacro(): void
    {
        Builder::macro('cursorPaginate', function ($limit, $columns) {
            $cursor = CursorPaginator::currentCursor();

            // Get the total before applying the cursor
            $total = $this->count();

            if ($cursor) {
                $apply = function ($query, $columns, $cursor) use (&$apply): void {

                    /** @var \Illuminate\Database\Eloquent\Builder $this */
                    $query->where(function ($query) use ($columns, $cursor, $apply) {
                        $column = key($columns);
                        $direction = array_shift($columns);
                        $value = array_shift($cursor);

                        $query->where($column, $direction === 'asc' ? '>' : '<', $value);

                        if (! empty($columns)) {
                            $query->orWhere($column, $value);
                            $apply($query, $columns, $cursor);
                        }
                    });
                };

                $apply($this, $columns, $cursor);
            }

            foreach ($columns as $column => $direction) {
                $this->orderBy($column, $direction);
            }

            $items = $this->limit($limit + 1)->get();

            if ($items->count() <= $limit) {
                return new CursorPaginator($items, $total);
            }

            $items->pop();

            return new CursorPaginator($items, $total, array_map(function ($column) use ($items) {
                $value = $items->last()->{$column};
                if ($value instanceof \DateTimeInterface) {
                    $format = $value->format('v') > 0 ? 'Y-m-d H:i:s.v' : 'Y-m-d H:i:s';
                    $value = $value->format($format);
                }

                return $value;
            }, array_keys($columns)));
        });
    }
}
