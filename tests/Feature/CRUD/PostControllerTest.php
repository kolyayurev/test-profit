<?php

use App\Models\User;
use App\Models\Post;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;

beforeEach(function () {
    $this->seed(RoleSeeder::class);
    $this->seed(UserSeeder::class);
});

test('posts index screen can be rendered', function () {

    $user = User::query()->first();

    $this->actingAs($user);

    $response = $this->get(route('posts.index',absolute: false));

    $response->assertStatus(200);
});

test('posts create screen can be rendered', function () {

    $user = User::query()->first();

    $this->actingAs($user);

    $response = $this->get(route('posts.create',absolute: false));

    $response->assertStatus(200);
});

test('posts edit screen can be rendered for owner', function () {

    $editor = User::query()->where('name','Editor')->first();

    $this->actingAs($editor);

    $post = Post::factory()->create(['user_id'=>$editor->id]);

    $response = $this->get(route('posts.edit',$post->id, absolute: false));

    $response->assertStatus(200);
});

test('posts edit screen can not be rendered for stranger', function () {

    $admin = User::query()->where('name','Admin')->first();
    $editor = User::query()->where('name','Editor')->first();

    $this->actingAs($editor);

    $post = Post::factory()->create(['user_id'=>$admin->id]);

    $response = $this->get(route('posts.edit',$post->id, absolute: false));

    $response->assertStatus(403);
});

test('posts edit screen can be rendered for admin', function () {

    $admin = User::query()->where('name','Admin')->first();
    $editor = User::query()->where('name','Editor')->first();

    $this->actingAs($admin);

    $post = Post::factory()->create(['user_id'=>$editor->id]);

    $response = $this->get(route('posts.edit',$post->id, absolute: false));

    $response->assertStatus(200);
});

test('posts delete can be access for owner', function () {

    $editor = User::query()->where('name','Editor')->first();

    $this->actingAs($editor);

    $post = Post::factory()->create(['user_id'=>$editor->id]);

    $response = $this->delete(route('posts.destroy',$post->id, absolute: false));

    $response->assertStatus(302);
});

test('posts delete can not be access for stranger', function () {

    $admin = User::query()->where('name','Admin')->first();
    $editor = User::query()->where('name','Editor')->first();

    $this->actingAs($editor);

    $post = Post::factory()->create(['user_id'=>$admin->id]);

    $response = $this->delete(route('posts.destroy',$post->id, absolute: false));

    $response->assertStatus(403);
});

test('posts delete can be access for admin', function () {

    $admin = User::query()->where('name','Admin')->first();
    $editor = User::query()->where('name','Editor')->first();

    $this->actingAs($admin);

    $post = Post::factory()->create(['user_id'=>$editor->id]);

    $response = $this->delete(route('posts.destroy',$post->id, absolute: false));

    $response->assertStatus(302);
});
