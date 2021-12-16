<?php

namespace App\Http\Controllers;

use App\Http\Requests\addPostRequest;
use App\Http\Requests\editPostRequest;
use App\Http\Requests\PostIdRequest;
use App\Http\Resources\PostCollection;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class PostController
{
    private $postService;
    private $userService;

    public function __construct(PostService $postService, UserService $userService)
    {
        $this->postService = $postService;
        $this->userService = $userService;
    }

    /**
     * posts page
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function postsPage()
    {
        if (Auth::check()) {
            $this->userService->updateAPIToken();
        }

        $posts = $this->postService->getPosts();

        return view('posts', compact('posts'));
    }

    /**
     * get all posts
     *
     * @return json
     */
    public function getPosts()
    {
        $data = $this->postService->getPosts();

        return new PostCollection($data);
    }

    /**
     * add post page
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addPostPage()
    {
        $this->userService->updateAPIToken();

        return view('addPost');
    }

    /**
     * add post
     *
     * @param addPostRequest $request
     * @return json
     */
    public function addPost(addPostRequest $request)
    {
        $result = $this->postService->addPost($request);

        return response()->json([
            'result' => $result
        ]);
    }

    /**
     * delete post
     * 
     * @param PostIdRequest $request
     * @return json
     */
    public function deletePost(PostIdRequest $request)
    {
        $result = $this->postService->deletePost($request->post);

        return response()->json([
            'result' => $result
        ]);
    }

    /**
     * edit post page
     * 
     * @param PostIdRequest $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editPostPage(PostIdRequest $request)
    {
        $this->userService->updateAPIToken();

        $post = $this->postService->getPostById($request->post);

        return view('editPost', compact('post'));
    }

    /**
     * edit post
     *
     * @param editPostRequest $request
     * @return json
     */
    public function editPost(editPostRequest $request)
    {
        $result = $this->postService->editPost($request);

        return response()->json([
            'result' => $result
        ]);
    }
}
