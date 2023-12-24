<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Services\CommentService;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->post = Post::factory()->create();
    $this->actingAs($this->user);

    $this->service = app(CommentService::class);
});

test('comment service store', function () {

    $data = Comment::factory()->make()->toArray();

    $comment = $this->service->store($data);

    $commentData = $comment->only(array_keys($data));

    $this->assertEquals($data, $commentData);

});


test('comment service update', function () {

    $comment = Comment::factory()->create();

    $comment->body = $body = fake()->sentence(8);

    $this->service->update($comment->id,$comment->only('body'));

    $updatedComment = Comment::query()->find($comment->id);

    $this->assertEquals($body, $updatedComment->body);

});

test('comment service destroy', function () {

    $comment = Comment::factory()->create();

    $this->service->destroy($comment->id);

    $deletedComment = Comment::query()->find($comment->id);

    $this->assertEquals($deletedComment, null);

});
