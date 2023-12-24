<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;

beforeEach(function () {
    $this->seed(RoleSeeder::class);
    $this->seed(UserSeeder::class);
});

test('comments index screen can be rendered', function () {

    $user = User::query()->first();

    $this->actingAs($user);

    $response = $this->get(route('comments.index',absolute: false));

    $response->assertStatus(200);
});

test('comments create screen can be rendered', function () {

    $user = User::query()->first();

    $this->actingAs($user);

    $response = $this->get(route('comments.create',absolute: false));

    $response->assertStatus(200);
});

test('comments edit screen can be rendered for owner', function () {

    $editor = User::query()->where('name','Editor')->first();

    $this->actingAs($editor);

    Post::factory()->create();
    $comment = Comment::factory()->create(['user_id'=>$editor->id]);

    $response = $this->get(route('comments.edit',$comment->id, absolute: false));

    $response->assertStatus(200);
});

test('comments edit screen can not be rendered for stranger', function () {

    $admin = User::query()->where('name','Admin')->first();
    $editor = User::query()->where('name','Editor')->first();

    $this->actingAs($editor);

    Post::factory()->create();
    $comment = Comment::factory()->create(['user_id'=>$admin->id]);

    $response = $this->get(route('comments.edit',$comment->id, absolute: false));

    $response->assertStatus(403);
});

test('comments edit screen can be rendered for admin', function () {

    $admin = User::query()->where('name','Admin')->first();
    $editor = User::query()->where('name','Editor')->first();

    $this->actingAs($admin);

    Post::factory()->create();
    $comment = Comment::factory()->create(['user_id'=>$editor->id]);

    $response = $this->get(route('comments.edit',$comment->id, absolute: false));

    $response->assertStatus(200);
});

test('comments delete can be access for owner', function () {

    $editor = User::query()->where('name','Editor')->first();

    $this->actingAs($editor);

    Post::factory()->create();
    $comment = Comment::factory()->create(['user_id'=>$editor->id]);

    $response = $this->delete(route('comments.destroy',$comment->id, absolute: false));

    $response->assertStatus(302);
});

test('comments delete can not be access for stranger', function () {

    $admin = User::query()->where('name','Admin')->first();
    $editor = User::query()->where('name','Editor')->first();

    $this->actingAs($editor);

    Post::factory()->create();
    $comment = Comment::factory()->create(['user_id'=>$admin->id]);

    $response = $this->delete(route('comments.destroy',$comment->id, absolute: false));

    $response->assertStatus(403);
});

test('comments delete can be access for admin', function () {

    $admin = User::query()->where('name','Admin')->first();
    $editor = User::query()->where('name','Editor')->first();

    $this->actingAs($admin);

    Post::factory()->create();
    $comment = Comment::factory()->create(['user_id'=>$editor->id]);

    $response = $this->delete(route('comments.destroy',$comment->id, absolute: false));

    $response->assertStatus(302);
});
