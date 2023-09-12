@extends('layouts.login')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <label for="posts"></label>

        @if ($user->images != 'dawn.png')
            <img src="{{ asset('storage/images/' . $user->images) }}" width="50" height="50">
        @else
            <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
        @endif

        <textarea id="posts" class="post-form"name="posts" placeholder="何をつぶやこうか...?" row="4"></textarea>

        <button type="submit"><img src="images/post.png"></button>
    </form>
    <hr style="border: none; border-top: 5px solid #D7D7D7;">
    <ul>
        @foreach ($posts as $post)
            <li style="text-align: right;">{{ $post->created_at }}</li>

            <li>
                {{-- id指定したユーザーのshowページに遷移 --}}
                <a href="{{ route('users.show', ['id' => $post->user_id]) }}">
                    {{-- 等しくないとき --}}
                    @if ($post->user->images != 'dawn.png')
                        <img src="{{ asset('storage/images/' . $post->user->images) }}" width="50" height="50">
                    @else
                        <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
                    @endif
                </a>
                {{ $post->user->username }}
            </li>

            <li>{{ $post->posts }}</li>

            <li
                style="display: flex; justify-content:flex-end; text-align: right;  border-bottom: 1px solid #D7D7D7; margin-bottom: 50px; padding: 30px;">

                @if ($post->user_id == Auth::id())
                    <div class="post-edit">
                        <button class="edit-modal" data-id="{{ $post->id }}">
                            <img src="{{ asset('images/edit.png') }}" alt="edit" class="edit-image">
                        </button>
                    </div>

                    <div class="modal" id="modal{{ $post->id }}">
                        <div class="modal-edit">
                            <div class="inner-content">
                                <form action="{{ route('posts.update') }}" method="post" id="updateFome">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="posts" id="modalPosts" placeholder="{{ $post->posts }}" rows="5" class="form-edit"></textarea>
                                        <input type="hidden" name="id" value="{{ $post->id }}">
                                    </div>
                                    <button type="submit" class="form-submit"><img src="{{ asset('images/edit.png') }}"
                                            class="edit-image"></button>
                                </form>
                            </div>
                        </div>
                        <script>
                            $(function() {
                                $('.edit-modal').on('click', function() {
                                    var postId = $(this).data('id');

                                    $('#modal' + postId).fadeIn();
                                });

                                // モーダル外部クリック時のイベント
                                window.onclick = function(event) {
                                    if (event.target.classList.contains('modal')) {
                                        event.target.style.display = 'none';
                                    }
                                };
                            });
                        </script>
                    </div>

                    <div class="delete">
                        <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST"
                            onsubmit="return confirm('このつぶやきを削除します。よろしいでしょうか？')";>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="trash-button"><img src="images/trash.png"
                                    class="trash-image"></button>
                        </form>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
@endsection
