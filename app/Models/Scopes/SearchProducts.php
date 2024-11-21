<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SearchProducts implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model)
    {
        // Retrieve the search term from the request
        $searchTerm = request()->query('query');

        if (!empty($searchTerm)) {
            $builder->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $searchTerm . '%')
                      ->orWhere('meta_desc', 'like', '%' . $searchTerm . '%')
                      ->orWhere('meta_title', 'like', '%' . $searchTerm . '%')
                      ->orWhere('keywords', 'like', '%' . $searchTerm . '%')
                      ->orWhereRaw("title SOUNDS LIKE ?", [$searchTerm])
                      ->orWhereRaw("description SOUNDS LIKE ?", [$searchTerm])
                      ->orWhereRaw("keywords SOUNDS LIKE ?", [$searchTerm]);
            });
        }
    }
}
