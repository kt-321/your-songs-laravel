@extends("layouts.app")

@section("content")
<h1 class="mb-4 text-center page-title">
    <i class="fas fa-trash-alt mr-1"></i>
    曲の管理画面
</h1>

<div class="users-index mb-3">
    <h4 class="text-center">未削除</h4>
    <table border="1" class="m-auto text-center">
        <tbody>
            <tr>
                <th>曲ID</th>
                <th>曲名</th>
                <th>アーティスト</th>
                <th>曲の年代</th>
                <th>投稿者ＩＤ</th>
                <th>投稿者</th>
                <th>曲の詳細</th>
                <th>削除</th>
            </tr>
            @forelse ($songs as $song)
                <tr>
                    <td>{{ $song->id }}</td>
                    <td>{{ $song->title }}</td>
                    <td>{{ $song->artist_name }}</td>
                    <td>{{ $song->music_age }}</td>
                    <td>{{ $song->user_id }}</td>
                    <td><a href="{{ route("users.show", ["id" => $song->user->id]) }}">{{ $song->user->name }}</a></td>
                    <td>
                         <a class="btn btn-success btn-sm" href="{{ route("songs.show", ["id" => $song->id]) }}">曲の詳細</a>
                    </td>
                    <td>
                        <a href="/delete/{{ $song->id }}" onclick="delete_alert();return false;">削除</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
    
<div class="deleted-users-index">
    <h4 class="text-center">削除済</h4>
    <table border="1" class="m-auto text-center">
        <tbody>
            <tr>
                <th>曲ID</th>
                <th>曲名</th>
                <th>アーティスト</th>
                <th>曲の年代</th>
                <th>投稿者ＩＤ</th>
                <th>投稿者</th>
                <th>復旧</th>
                <th>完全削除</th>
            </tr>
            @forelse ($deleted as $delete)
                <tr>
                    <td>{{ $delete->id }}</td>
                    <td>{{ $delete->title }}</td>
                    <td>{{ $delete->artist_name }}</td>
                    <td>{{ $delete->music_age }}</td>
                    <td>{{ $delete->user_id }}</td>
                    <td><a href="{{ route("users.show", ["id" => $delete->user->id]) }}">{{ $delete->user->name }}</a></td>
                    <td>
                        <a href="/restore/{{ $delete->id }}">復旧</a>
                    </td>
                    <td>
                        <a href="/force-delete/{{ $delete->id }}">完全削除</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection