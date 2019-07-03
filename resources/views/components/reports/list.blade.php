@if(isset($reports) && sizeof($reports)>0)
    <table class="table table-hover">
        <thead>
        <tr class="table-info">
            <th scope="col">#</th>
            <th scope="col" style="width:20%">Campaign Name</th>
            <th scope="col">Banner</th>
            @if(\Illuminate\Support\Facades\Auth::user()->role_id==\App\Enum\UserRoles::ADMIN)<th scope="col">User</th>@endif
            <th scope="col">Views</th>
            <th scope="col">Clicks</th>
            @if(\Illuminate\Support\Facades\Auth::user()->role_id==\App\Enum\UserRoles::SHOP)<th scope="col">Budget</th>@endif
            @if(\Illuminate\Support\Facades\Auth::user()->role_id==\App\Enum\UserRoles::ADMIN)<th scope="col">Benefit</th>@else<th scope="col">Spend</th> @endif
        </tr>
        </thead>
        <tbody>
        @foreach($reports as $report)
            <tr onclick="getChart('/report/{{$report->id}}')">
                <th scope="row">{{$report->id}}</th>
                <td>{{$report->name}}</td>
                <td style="width: 20%"><img src="{{$report->banner}}" class="img-fluid img-thumbnail" alt="Responsive image"></td>
                @if(\Illuminate\Support\Facades\Auth::user()->role_id==\App\Enum\UserRoles::ADMIN)<td>{{$report->uname}}</td>@endif
                <td>{{$report->views}}</td>
                <td>{{$report->clicks}}</td>
                @if(\Illuminate\Support\Facades\Auth::user()->role_id==\App\Enum\UserRoles::SHOP)<td>{{number_format($report->budget)}} VND</td>@endif
                <td>{{number_format($report->benefit)}} VND</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $reports->links() }}
@else
    <br/>
    <h3>No result</h3>
@endif