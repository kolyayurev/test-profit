<?php

namespace App\Services;

use App\Models\Comment;

/**
 * @extends BaseService<Comment>
 */
class CommentService extends BaseService
{
    protected string $model = Comment::class;

}
