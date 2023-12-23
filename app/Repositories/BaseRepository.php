<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModelClass of Model
 */
abstract class BaseRepository
{
    /**
     * @var Builder<TModelClass>
     */
    protected Builder $query;

    protected string $model;

    public function __construct()
    {
        $this->query = app($this->model)->query();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getForList(int $perPage = 5): LengthAwarePaginator
    {
        return $this->query->paginate($perPage);
    }

    public function find(int $id): ?Model
    {
        return $this->query->find($id);
    }
}
