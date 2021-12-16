@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h4>{{ __('Edit Post') }}</h4>
        </div>

        <div class="col-md-10 my-2">
            <div class="card">
                <div class="card-body">
                    <form onsubmit="return editPost(event)">
                        <div class="form-group">
                            <textarea class="form-control" name="content" id="content" rows="5">{{ $post->content }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    function editPost(e) {
        e.preventDefault();

        $.ajax({
            method: 'post',
            url: '/api/editPost',
            headers: {
                'Authorization': 'Bearer ' + '{{ auth()->user()->api_token }}'
            },
            data: {post: {{ $post->pid }}, content: $('#content').val()},
            success: function (data) {
                if (data.hasOwnProperty('result') && data.result == 'success') {
                    alert('修改成功。');
                    location.href = '/home';
                } else {
                    console.log(data);
                    alert('修改失敗，請重新嘗試。');
                }
            },
            error: function (jqXHR, textStatus, errorThown) {
                console.log(jqXHR, textStatus, errorThown);
                alert('修改失敗，請重新嘗試。');
            }
        });
    }
</script>
@endsection