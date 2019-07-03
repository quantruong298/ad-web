<table class="table table-hover">
    <thead>
    <tr class="table-info">
        <th scope="col" width="10%">#</th>
        <th scope="col" width="15%">Name</th>
        <th scope="col" width="10%">Start Day</th>
        <th scope="col" width="10%">End Day</th>
        <th scope="col" width="10%">Budget</th>
        <th scope="col" width="10%">Bid Amount</th>
        <th scope="col" width="15%">Banner</th>
        <th scope="col" width="10%">Status</th>
        <th scope="col" width="10%">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($campaigns as $campaign)
        <tr>
            <th scope="row">{{ $campaign->id }}</th>
            <td>{{ $campaign->name }}</td>
            <td>{{ $campaign->start_day }}</td>
            <td>{{ $campaign->end_day }}</td>
            <td>{{ number_format($campaign->budget )}}</td>
            <td>{{ number_format($campaign->bid_amount) }}</td>
            <td><img src="{{ $campaign->banner }}" class="img-fluid img-thumbnail" alt="Responsive image"></td>
            <td>
                {{ ($campaign->status ==  1 ) ? 'active' : "inactive" }}
            </td>
            <td class="btn-group">
                @if(Auth::user()->role_id == \App\Enum\UserRoles::SHOP)
                    <button type="button" class="btn-sm btn-primary"
                            onclick="getInfoCampaignById( {{$campaign->id }} )"><i
                                class="fa fa-edit"></i>
                    </button>
                @endif
                <button type="button" class="btn-sm btn-danger" onclick="deleteCampaign( {{ $campaign->id }} )"><i
                            class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $campaigns->links() }}
