<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;

class PostService
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * get all posts
     *
     * @return array
     */
    public function getPosts()
    {
        $posts = $this->postRepository->getPosts()->sortByDesc('created_at')->values();

        return $posts;
    }

    /**
     * add post
     *
     * @param App\Http\Requests\addPostRequest $request
     * @return string
     */
    public function addPost($request)
    {
        $result = $this->postRepository->addPost($request->all());

        return $result;
    }

    /**
     * delete post by pid
     * 
     * @param integer $pid
     * @return string
     */
    public function deletePost($pid)
    {
        $post = $this->postRepository->getPostById($pid);

        if (is_null($post)) {
            return 'fail';
        } else {
            if ($post->uid == Auth::id()) {
                $this->postRepository->deletePostById($pid);

                return 'success';
            } else {
                return 'fail';
            }
        }
    }

    /**
     * get post by pid
     * 
     * @param integer $pid
     * @return App\Models\Post
     */
    public function getPostById($pid)
    {
        $post = $this->postRepository->getPostById($pid);

        if (!is_null($post) && $post->uid == Auth::id()) {
            return $post;
        } else {
            return 'fail';
        }
    }

    /**
     * edit post
     * 
     * @param App\Http\Requests\editPostRequest
     * @return string
     */
    public function editPost($request)
    {
        $post = $this->postRepository->getPostById($request->post);

        if (is_null($post)) {
            return 'fail';
        } else {
            if ($post->uid == Auth::id()) {
                $this->postRepository->updatePostById($request->all());

                return 'success';
            } else {
                return 'fail';
            }
        }
    }
}
