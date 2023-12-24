<?php

use App\Models\Post;
use App\Models\User;
use App\Services\PostService;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);

    $this->service = app(PostService::class);
});

test('post service store', function () {

    $data = Post::factory()->make()->toArray();

    $post = $this->service->store($data);

    $postData = $post->only(array_keys($data));

    $this->assertEquals($data, $postData);

});


test('post service update', function () {

    $post = Post::factory()->create();

    $post->title = $title = fake()->sentence(8);

    $this->service->update($post->id,$post->only('title'));

    $updatedPost = Post::query()->find($post->id);

    $this->assertEquals($title, $updatedPost->title);

});

test('post service destroy', function () {

    $post = Post::factory()->create();

    $this->service->destroy($post->id);

    $deletedPost = Post::query()->find($post->id);

    $this->assertEquals($deletedPost, null);

});
