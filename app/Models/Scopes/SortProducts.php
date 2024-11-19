<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SortProducts implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $sort = request()->query('sort');

        switch ($sort) {
            case 'most-popular':
                // Assuming 'views' is a column that represents popularity
                $builder->topOrders();
                break;
            case 'oldest':
                $builder->oldestProducts();
                break;
            case 'price-low':
                $builder->price('asc');
                break;
            case 'price-high':
                $builder->price('desc');
                break;
            default:
                // Default sorting logic, if any
                $builder->latestProducts();
        }
    }
}
