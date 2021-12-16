@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h4>{{ __('Posts List') }}</h4>
        </div>

        @if (count($posts) > 0)
            @foreach ($posts as $post)
            <div class="col-md-10 my-2 post">
                <div class="card">
                    <div class="card-body">
                        <p>{{ $post->user->name }} :</p>
                        <p>{!! $post->content !!}</p>
                        <p>
                            at {{ $post->created_at }} 
                            @if ($post->uid == auth()->id())
                            (<a href="javascript:void(0);" onclick="deletePost(event, {{ $post->pid }})">{{ __('Delete') }}</a>
                            |
                            <a href="/editPost/{{ $post->pid }}">{{ __('Edit') }}</a>)
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

        <div class="col-md-10 my-2" id="no_post" style="display:none;">
            <div class="card">
                <div class="card-body">
                    {{ __('There is no post.') }}
                </div>
            </div>
        </div>
        @else
        <div class="col-md-10 my-2">
            <div class="card">
                <div class="card-body">
                    {{ __('There is no post.') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('script')
    @auth
    <script>
        function deletePost(event, post) {
            $.ajax({
                method: 'get',
                url: '/api/deletePost?post=' + post,
                headers: {
                    'Authorization': 'Bearer ' + '{{ auth()->user()->api_token }}'
                },
                success: function (data) {
                    if (data.hasOwnProperty('result') && data.result == 'success') {
                        alert('刪除成功。');
                        event.target.closest('div.col-md-10').remove();
                        if ($('.post').length == 0) {
                            $('#no_post').show();
                        }
                    } else {
                        console.log(data);
                        alert('刪除失敗，請重新嘗試。');
                    }
                },
                error: function (jqXHR, textStatus, errorThown) {
                    console.log(jqXHR, textStatus, errorThown);
                    alert('刪除失敗，請重新嘗試。');
                }
            });
        }
    </script>
    @endauth
@endsection