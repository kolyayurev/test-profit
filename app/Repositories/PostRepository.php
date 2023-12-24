<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends BaseRepository<Post>
 *
 * @implements PostRepositoryContract<Post>
 */
class PostRepository extends BaseRepository implements PostRepositoryContract
{
    protected string $model = Post::class;

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getForList(int $perPage = 5): LengthAwarePaginator
    {
        return $this->query
            ->when(!auth()->user()->isAdmin(), function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->with('user')->paginate($perPage);
    }

    public function getForSelect(): array
    {
        return array_column($this->query->get()->toArray(),'title','id');
    }


}
