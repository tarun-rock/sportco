<table class="table table-hover table-striped" >
    <thead>
    <tr>
        <th>Title </th>

        <th>Approval Tokens</th>
        <th>Bonus Tokens</th>
        <th>Likes</th>
        <th>Views</th>
        <th>Date of Approval</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <td>

                {{ $post->title }}
            </td>

            <td>{{$post->normal_tokens ?? 0}}</td>
            <td>{{$post->bonus_tokens ?? 0}}</td>
            <td>{{$post->likes ?? 0}}</td>
            <td>{{$post->views ?? 0}}</td>
            {{--<td>{{ date_format(,"d-F-Y")}}</td>--}}
            <td>
                @if($post->status == returnConfig("accepted_post"))
                {{$post->date}}
                    @else
                    -
                    @endif
            </td>
            <td>

                @if($post->status == returnConfig("pending_post"))
                    <badge class="badge badge-primary">Awaiting Approval</badge>
                @elseif($post->status == returnConfig("accepted_post"))
                    <badge class="badge badge-success">Approved</badge>
                @elseif($post->status == returnConfig("rejected_post"))
                    <badge class="badge badge-danger">Rejected</badge>
                @elseif($post->status == returnConfig("draft"))
                    <a href="{{ url("edit-post") }}/{{ $post->id  }}" style="color: #fff;" class="badge badge-info">Draft <i class="fa fa-pen"></i></a>
                @endif
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
<div class="c_nav" >
    {{ $posts->links() }}
</div>