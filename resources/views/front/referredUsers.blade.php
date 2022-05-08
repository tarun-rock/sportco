<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Tokens Received</th>
        <th>Date Joined</th>
    </tr>
    </thead>
    <tbody>
    @foreach($referredusers as $referreduser)
        <tr>
            <td>
                 {{--{{$referreduser->name}}{{$referreduser->id}}--}}
                {{$referreduser->name}}
            </td>
            <td>
                {{$referreduser->tokens}}
            </td>
            <td>{{ date_format($referreduser->created_at,"d-F-Y")}}</td>

        </tr>
    @endforeach
    </tbody>
</table>
<div class="c_nav" >
    {{ $referredusers->links() }}
</div>

