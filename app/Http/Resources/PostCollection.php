<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'result' => 'success',
            'posts' => $this->collection->map(function ($post) {
                return [
                    'pid' => $post->pid,
                    'uid' => $post->uid,
                    'poster' => $post->user->name,
                    'content' => $post->content,
                    'created_at' => $post->created_at->toDateTimeString()
                ];
            })
        ];
    }
}
