<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @extends BaseService<Comment>
 */
class CommentService extends BaseService
{
    protected string $model = Comment::class;

    public function store(array $data): Model
    {
        return $this->query->create(array_merge($data, [
                'user_id' => auth()->id(),
            ]
        ));
    }
}
