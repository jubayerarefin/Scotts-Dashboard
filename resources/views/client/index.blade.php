@extends('home')

@section('content')
<div class="row">
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered display nowrap" style="width:100%"
            id="table_content">
            <tr>
                <th data-class-name="priority">
                    User ID
                </th>
                <th>
                    Email
                </th>
                <th>
                    First Name
                </th>
                <th>
                    Last Name
                </th>
                <th>
                    Organization Name
                </th>
                <th>
                    Scott's Org ID
                </th>
                <th style="white-space: inherit">
                    Last Journal Update
                    (Time)
                </th>
                <th style="white-space: inherit">
                    Last Journal Update
                    (Date)
                </th>
                <th style="white-space: inherit">
                    Created At (User)
                </th>
                <th style="white-space: inherit">
                    Created At
                    (Organization)
                </th>
                <th>
                    Subscribed until
                </th>
            </tr>
            @foreach($clients as $row)
            <tr>
                <td>{{$row->UserId}}</td>
                <td>{{$row->Email}}</td>
                <td>{{$row->FirstName}}</td>
                <td>{{$row->LastName}}</td>
                <td>{{$row->OrganizationName}}</td>
                <td>{{$row->ScottsOrgId}}</td>
                <td>{{$row->LastJournalUpdateTime}}</td>
                <td>{{$row->LastJournalUpdateDate}}</td>
                <td>{{$row->CreatedAtUser}}</td>
                <td>{{$row->CreatedAtOrganization}}</td>
                <td>{{$row->SubscribedUntil}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection