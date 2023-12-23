<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @extends BaseService<Post>
 */
class PostService extends BaseService
{
    protected string $model = Post::class;

    public function store(array $data): Model
    {
        return $this->query->create(array_merge($data, [
                'user_id' => auth()->id(),
                'slug' => data_get($data, 'slug') ?? Str::slug(data_get($data, 'title'))
            ]
        ));
    }

}
