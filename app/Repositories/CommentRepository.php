<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @extends BaseRepository<Comment>
 *
 */
class CommentRepository extends BaseRepository
{
    protected string $model = Comment::class;

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
            ->with(['user','post'])->paginate($perPage);
    }



}
