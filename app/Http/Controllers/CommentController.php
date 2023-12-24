<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use App\Services\CommentService;

class CommentController extends Controller
{

    public function __construct(
        protected CommentService $service,
        protected CommentRepository $repository,
        protected PostRepository $postRepository,
    )
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',Comment::class);

        $comments = $this->repository->getForList();

        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Comment::class);

        $comment = new Comment();

        $posts = $this->postRepository->getForSelect();

        return view('comments.form', compact('comment','posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $this->authorize('create',Comment::class);

        $comment = $this->service->store($request->validated());

        return redirect()->route('comments.edit', $comment->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $this->authorize('update',$comment);

        $posts = $this->postRepository->getForSelect();

        return view('comments.form', compact('comment','posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $this->authorize('update',$comment);

        $this->service->update($comment->id,$request->validated());

        return redirect()->route('comments.edit', $comment->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete',$comment);

        $this->service->destroy($comment->id);

        return redirect()->route('comments.index');
    }
}
