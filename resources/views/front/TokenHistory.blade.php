<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th>Amount Requested (SPCO)</th>
        <th>Transaction Fee (SPCO)</th>
        <th>Amount Receivable (SPCO)</th>
        <th>Request Date</th>
        <th>Status</th>

    </tr>
    </thead>
    <tbody>
    @foreach($tokenshisotry as $token)
        <tr>
            <td>
                {{ $token->tokens ?? 0 }}
            </td>
            <td>{{ round($token->spco_tokenval ?? 0,4) }}
            <td>{{round($token->withdrawalToken ?? 0,4)}}</td>
            </td>

            <td>{{ date_format($token->created_at,"d-F-Y")}}</td>
            <td>

                @if($token->status == 0)
                <div class="badge badge-warning">Pending</div>
                @elseif($token->status == 1)
                    <div class="badge badge-success">Approved</div>
                @else()
                    <div class="badge badge-danger">Declined</div>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="c_nav" >
    {{ $tokenshisotry->links() }}
</div>

