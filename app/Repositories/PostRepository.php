<?php

namespace App\Repositories;

use App\Models\Post as PostModel;
use Illuminate\Support\Facades\Auth;

class PostRepository
{
    private $postModel;

    public function __construct(PostModel $postModel)
    {
        $this->postModel = $postModel;
    }

    /**
     * get all posts
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getPosts()
    {
        $posts = $this->postModel->with('User')->get();

        return $posts;
    }

    /**
     * add post
     *
     * @param array $data
     * @return string
     */
    public function addPost($data)
    {
        $post = new PostModel();
        $post->uid = Auth::id();
        $post->content = nl2br($data['content']);
        $post->save();

        return 'success';
    }

    /**
     * get post by pid
     * 
     * @param integer $pid
     * @return App\Models\Post|null
     */
    public function getPostById($pid)
    {
        $post = PostModel::find($pid);

        return $post;
    }

    /**
     * delete post by pid
     * 
     * @param integer $pid
     */
    public function deletePostById($pid)
    {
        $post = PostModel::find($pid);
        $post->delete();
    }

    /**
     * update post by pid
     * 
     * @param array $data
     */
    public function updatePostById($data)
    {
        $post = PostModel::find($data['post']);
        $post->content = $data['content'];
        $post->save();
    }
}
