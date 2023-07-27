@extends('layouts.login')

@section('content')
<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <label for="posts"></label>

    @if($user->images != 'dawn.png')
    <img src="{{ asset('storage/images/' . $user->images) }}" width="50" height="50">
    @else
    <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
    @endif

    <textarea id="posts" name="posts" placeholder="何をつぶやこうか...?" row="4"></textarea>

    <button type="submit"><img src="images/post.png"></button>
</form>
<hr style="border: none; border-top: 5px solid #D7D7D7;">
<ul>
    @foreach($posts as $post)

    <li style="text-align: right;">{{ $post->created_at }}</li>

    <li>
        <a href="{{ route('users.show', ["id" => $post->user_id]) }}">
            @if($post->user->images != 'dawn.png')
            <img src="{{ asset('storage/images/' . $post->user->images) }}" width="50" height="50">
            @else
            <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
            @endif
        </a>
        {{ $post->user->username }}
    </li>

    <li>{{ $post->posts }}</li>

    <li style="display: flex; justify-content:flex-end; text-align: right;  border-bottom: 1px solid #D7D7D7; margin-bottom: 50px; padding: 30px;">

        <form action="{{ route('posts.update', $post->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <textarea name="content" id="posts"  placeholder="{{ $post->posts }}" rows="5" class="form-control">{{ $post->posts }}</textarea>
            </div>
            <button type="submit" class="btn-primary"><img src="{{ asset('images/edit.png') }}"></button>
        </form>

        <!-- ポップアップモーダル -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">確認</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">更新しますか？</div>
                    <div class="modal-footer">
                        <button type="button" class="btn-secondary" data-dismiss="modal">キャンセル</button>
                        <button type="button" class="btn-primary" id="confirmUpdate"><img src="{{ asset('images/edit.png') }}"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ポップアップモーダル表示用JavaScript -->
        <script>
            $(document).ready(function(){
                $('#confirmUpdate').on('click', function(){
                    $('#confirmationModal').modal('show');
                });

                $('#confirmationModal').on('click', '#confirmUpdate', function(){
                    $('form').submit();
                });
            });
        </script>

        <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST" onsubmit="return confirm('このつぶやきを削除します。よろしいでしょうか？')";>
            @csrf
            @method('DELETE')
            <button type="submit"><img src="images/trash.png"></button>
        </form>
    </li>
    @endforeach
</ul>
@endsection
