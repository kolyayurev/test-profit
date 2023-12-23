<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModelClass of Model
 */
interface PostRepositoryContract
{
    public function getForList(int $perPage = 5): LengthAwarePaginator;
}
