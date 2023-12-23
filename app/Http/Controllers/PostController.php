<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Repositories\PostRepositoryContract;
use App\Services\PostService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct(
        protected PostService $service,
        protected PostRepositoryContract $repository,
    )
    {
    }

    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny',Post::class);

        $posts = $this->repository->getForList();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Post::class);

        $post = new Post();

        return view('posts.form', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $this->authorize('create',Post::class);

        $post = $this->service->store($request->validated());

        return redirect()->route('posts.edit', $post->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update',$post);

        return view('posts.form', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update',$post);

        $this->service->update($post->id,$request->validated());

        return redirect()->route('posts.edit', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);

        $this->service->destroy($post->id);

        return redirect()->route('posts.index');

    }
}
