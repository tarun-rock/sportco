<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th width="40%">Name</th>
        <th>Score</th>
        <th>Time</th>

    </tr>
    </thead>
    <tbody>
    @foreach($games as $game)
        <tr>
            <td>
                {{ $game->name }}
            </td>
            <td>{{$game->score}}</td>
            <td>{{$game->time}} <small>sec</small></td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="c_nav" >
    {{ $games->links() }}
</div>

