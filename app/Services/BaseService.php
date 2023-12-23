<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModelClass of Model
 */
abstract class BaseService
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
     * @param  array<string, mixed>  $data
     */
    public function store(array $data): Model
    {
        return $this->query->create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(int $id, array $data): int
    {
        return $this->query->where('id', $id)->update($data);
    }

    public function destroy(int $id): mixed
    {
        return $this->query->where('id', $id)->delete();
    }
}
