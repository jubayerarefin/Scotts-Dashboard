<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scott's Add-Ins</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
</head>

<body>
    <div class="container">
        <br />
        <h3 align="center">Scott's Add-Ins</h3>
        <br />
        <br />
        <div class="row ">
            <div class="col-md-4 input-daterange">
                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date"
                    readonly />
            </div>
            <div class="col-md-4 input-daterange">
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
            </div>
            <div class="col-md-4">
                <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
            </div>
        </div>
        <br />
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="order_table">
                <thead>
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
                </thead>
            </table>
        </div>
    </div>
</body>

</html>

<script>
$(document).ready(function() {
    $('.input-daterange').datepicker({
        todayBtn: 'linked',
        format: 'mm-dd-yyyy',
        autoclose: true
    });

    load_data();

    function load_data(from_date = '', to_date = '') {
        $('#order_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("daterange.index") }}',
                data: {
                    from_date: from_date,
                    to_date: to_date
                }
            },
            columns: [{
                    data: 'UserId',
                    name: 'UserId'
                },
                {
                    data: 'Email',
                    name: 'Email'
                },
                {
                    data: 'FirstName',
                    name: 'FirstName'
                },
                {
                    data: 'LastName',
                    name: 'LastName'
                },
                {
                    data: 'OrganizationName',
                    name: 'OrganizationName'
                },
                {
                    data: 'ScottsOrgId',
                    name: 'ScottsOrgId'
                },
                {
                    data: 'LastJournalUpdateTime',
                    name: 'LastJournalUpdateTime'
                },
                {
                    data: 'LastJournalUpdateDate',
                    name: 'LastJournalUpdateDate'
                },
                {
                    data: 'CreatedAtUser',
                    name: 'CreatedAtUser'
                },
                {
                    data: 'CreatedAtOrganization',
                    name: 'CreatedAtOrganization'
                },
                {
                    data: 'SubscribedUntil',
                    name: 'SubscribedUntil'
                },
            ]
        });
    }

    $('#filter').click(function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '') {
            $('#order_table').DataTable().destroy();
            load_data(from_date, to_date);
        } else {
            alert('Both Dates required');
        }
    });

    $('#refresh').click(function() {
        $('#from_date').val('');
        $('#to_date').val('');
        $('#order_table').DataTable().destroy();
        load_data();
    });

});
</script>

<!-- @foreach($clients as $row)
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
                    @endforeach -->

<!-- <div class="row justify-content-center">
        <form method="POST">

            <div class="form-group">
                <div class="row" style="padding-top: 10px">
                    <label class="col-lg-5 control-label" for="Email">Email</label>
                    <div class="col">
                        <input class="form-control" type="text" name="Email" id="Email" placeholder="Email" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row" style="padding-top: 10px">
                    <label class="col-lg-5 control-label" for="from_date">From Date</label>
                    <div class="col">
                        <input class="form-control daterange" data-date-format="mm/dd/yyyy" autocomplete="off"
                            name="from_date" id="datepicker_from" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row" style="padding-top: 10px">
                    <label class="col-lg-5 control-label" for="to_date">To Date</label>
                    <div class="col">
                        <input class="form-control datepicker" data-date-format="mm/dd/yyyy" autocomplete="off"
                            name="to_date" id="datepicker_to" />
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
        </form>
    </div> -->